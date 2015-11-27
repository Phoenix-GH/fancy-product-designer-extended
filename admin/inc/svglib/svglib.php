<?php

/**
 *
 * Description: Implementation SVGDocument include in all other libs
 *
 * Class pre-requisites:
 * - SimpleXmlElement - http://php.net/manual/en/class.simplexmlelement.php
 * - gzip support (for compressed svg) - http://php.net/manual/en/book.zlib.php
 * - imagemagick to export to png - http://php.net/manual/en/book.imagick.php
 * - GD to use embed image - http://php.net/manual/pt_BR/book.image.php
 *
 * @link phpsvg.nostaljia.eng.br
 * @link http://trialforce.nostaljia.eng.br
 * @link http://www.w3.org/TR/SVG/
 *
 * Started at Mar 11, 2010
 * Current version 0.8 01/01/2013
 *
 * @author Eduardo Bonfandini
 *
 * -----------------------------------------------------------------------
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU Library General Public License as published
 *   by the Free Software Foundation; either version 3 of the License, or
 *   (at your option) any later version.
 *
 *   This program is distributed in the hope that it will be useful,
 *   but WITHOUT ANY WARRANTY; without even the implied warranty of
 *   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *   GNU Library General Public License for more details.
 *
 *   You should have received a copy of the GNU Library General Public
 *   License along with this program; if not, access
 *   http://www.fsf.org/licensing/licenses/lgpl.html or write to the
 *   Free Software Foundation, Inc., 675 Mass Ave, Cambridge, MA 02139, USA.
 * ----------------------------------------------------------------------
 */
//include all clsses needed by lib
//TODO autoload
include('xmlelement.php'); //extends SimpleXmlElement
include('svgstyle.php'); //generic shape
include('svgshape.php'); //generic shape
include('svgshapeex.php'); //extended shape
include('svgpath.php'); //path object
include('svgline.php'); //line object
include('svgrect.php'); //rect object
include('svgcircle.php'); //circle object
include('svgellipse.php'); //ellipse object
include('svgtext.php'); //text object
include('svgimage.php'); //image object suports embed image
include('svglineargradient.php'); //gradient
include('svgradialgradient.php'); //gradient
include('svgstop.php'); //one color/stop of
include('svggroup.php'); //group
include('svgclippath.php'); //clippath
/**
 *

 *
 * Reference site:
 * http://www.leftontheweb.com/message/A_small_SimpleXML_gotcha_with_namespaces
 * http://blog.jondh.me.uk/2010/10/resetting-namespaced-attributes-using-simplexml/
 * http://www.w3.org/TR/SVG/
 */

class SVGDocument extends SVGShape
{

    const VERSION = '1.1';
    const XMLNS = 'http://www.w3.org/2000/svg';
    const EXTENSION = 'svg';
    const EXTENSION_COMPACT = 'svgz';
    const HEADER = 'image/svg+xml';
    const EXPORT_TYPE_IMAGE_MAGIC = 'imagick';
    const EXPORT_TYPE_INKSCAPE = 'inkscape';

    /**
     * Return the extension of a filename
     *
     * @param string $filename the filename to get the extension
     * @return string the filename to get the extension
     */
    protected static function getFileExtension( $filename )
    {
        $explode = explode( '.', $filename );
        return strtolower( $explode[ count( $explode ) - 1 ] );
    }

    /**
     * Return a SVGDocument
     *
     * If filename is not passed create a default svg.
     *
     * Supports gzipped content.
     *
     * @param $filename the file to load
     * @param $SVGClass class to construct the SVG, default SVGDocument, used for created using extended classes
     *
     * @return SVGDocument
     */
    public static function getInstance( $filename = null, $SVGClass = 'SVGDocument' )
    {
        if ( !$SVGClass )
        {
            $SVGClass = 'SVGDocument';
        }

        if ( $filename )
        {
            //if is svgz use compres.zlib to load the compacted SVG
            if ( SVGDocument::getFileExtension( $filename ) == self::EXTENSION_COMPACT )
            {
                //verify if zlib is installed
                if ( !function_exists( 'gzopen' ) )
                {
                    throw new Exception( 'GZip support not installed.' );
                    return false;
                }

                $filename = 'compress.zlib://' . $filename;
            }

            //get the content
            $content = file_get_contents( $filename );

            //throw error if not found
            if ( !$content )
            {
                throw new Exception( 'Impossible to load content of file ' . $filename );
            }

            $svg = new $SVGClass( $content );
        }
        else
        {
            //create clean SVG
            $svg = new $SVGClass( '<?xml version="1.0" encoding="UTF-8" standalone="no"?><svg></svg>' );

            //define the default parameters A4 pageformat
            $svg->setWidth( '210mm' );
            $svg->setHeight( '297mm' );
            $svg->setVersion( self::VERSION );
            $svg->setAttribute( 'xmlns', self::XMLNS );
        }

        return $svg;
    }

    /**
     * Out the file, used in browser situation,
     * because it changes the header to xml header
     *
     */
    public function output()
    {
        header( 'Content-type: ' . self::HEADER );
        echo $this->asXML();
    }

    /**
     * Export the object as xml text, OR xml file.
     *
     * If the file extension is svgz, the function will save it correctely;
     *
     * @param string $filename the file to save, is optional, you can output to a var
     * @return string the xml string if filename is not passed
     */
    public function asXML( $filename = null, $humanReadable = true )
    {
        //if is svgz use compres.zlib to load the compacted SVG
        if ( SVGDocument::getFileExtension( $filename ) == self::EXTENSION_COMPACT )
        {
            //verify if zlib is installed
            if ( !function_exists( 'gzopen' ) )
            {
                throw new Exception( 'GZip support not installed.' );
            }

            $filename = 'compress.zlib://' . $filename;
        }

        $xml = parent::asXML( null, $humanReadable );

        //need to do it, if pass a null filename it return an error
        if ( $filename )
        {
            return file_put_contents( $filename, $xml );
        }

        return $xml;
    }

    /**
     * Define the version of SVG document
     *
     * @param string $version
     */
    public function setVersion( $version )
    {
        $this->setAttribute( 'version', $version );

        return $this;
    }

    /**
     * Get the version of SVG document
     *
     * @param string $version
     */
    public function getVersion()
    {
        return $this->getAttribute( 'version' );
    }

    /**
     * Define the page dimension , width.
     *
     * @example setWidth('350px');
     * @example setWidth('350mm');
     *
     * @param string $width
     */
    public function setWidth( $width )
    {
        $this->setAttribute( 'width', $width );

        return $this;
    }

    /**
     * Set the view box attribute, used to make SVG resizable in browser.
     *
     * @param string $startX start x coordinate
     * @param string $startY start y coordinate
     * @param string $width width
     * @param string $height height
     */
    public function setViewBox( $startX, $startY, $width, $height )
    {
        $viewBox = str_replace( array( '%', 'px' ), '', "$startX $startY $width $height" );
        $this->setAttribute( 'viewBox', $viewBox );

        return $this;
    }

    /**
     * Set the default view box, based on width and height.
     *
     * Used to make SVG resizable in browser.
     */
    public function setDefaultViewBox()
    {
        return $this->setViewBox( 0, 0, $this->getWidth(), $this->getHeight() );
    }

    /**
     * Returns the width of page
     *
     * @return string the width of page
     */
    public function getWidth()
    {
        return $this->getAttribute( 'width' );
    }

    /**
     * Define the height of page.
     *
     * @param string $height
     *
     * @example setHeight('350mm');
     * @example setHeight('350px');
     */
    public function setHeight( $height )
    {
        $this->setAttribute( 'height', $height );

        return $this;
    }

    /**
     * Returns the height of page
     *
     * @return string the height of page
     */
    public function getHeight()
    {
        return $this->getAttribute( 'height' );
    }

    /**
     * Add a shape to SVG graphics
     *
     * @param XMLElement $append the element to append
     */
    public function addShape( $append )
    {
        $this->append( $append );

        return $this;
    }

    /**
     * Add some element to defs, normally a gradient
     *
     * @param XMLElement $element
     */
    public function addDefs( $element )
    {
        if ( !$this->defs )
        {
            $defs = new XMLElement( '<defs></defs>' );
            $this->append( $defs );
        }

        $this->defs->append( $element );
    }

    /**
     * Add some script content to svg
     *
     * @param text $script
     */
    public function addScript( $script )
    {
        $element = new XMLElement( '<script>' . $script . '</script>' );
        $this->append( $element );

        return $this;
    }

    /**
     * Return the definitions of the document, normally has gradients.
     *
     * @return SVGElement
     */
    public function getDefs()
    {
        return $this->defs;
    }

    /**
     * Export to a image file, consider file extension
     * Uses imageMagick or inkcape. If one fail try other.
     *
     * Try to define the complete path of files, works better for exportation.
     *
     * @param string $filename
     * @param integer $width the width of exported image
     * @param integer $height the height of exported image
     * @param boolean $respectRatio respect the ratio, image proportion
     * @param string $exportType the default export type
     */
    public function export( $filename, $width = null, $height = null, $respectRatio = false, $exportType = SVGDocument::EXPORT_TYPE_IMAGE_MAGIC )
    {
        if ( $exportType == SVGDocument::EXPORT_TYPE_IMAGE_MAGIC )
        {
            try
            {
                return $this->exportImagick( $filename, $width, $height, $respectRatio );
            }
            catch ( Exception $e )
            {
                try
                {
                    return $this->exportInkscape( $filename, $width, $height );
                }
                catch ( Exception $exc )
                {
                    $exc = null;
                    throw $e; //throw the first error
                }
            }
        }
        else
        {
            try
            {
                return $this->exportInkscape( $filename, $width, $height );
            }
            catch ( Exception $e )
            {
                try
                {
                    return $this->exportImagick( $filename, $width, $height, $respectRatio );
                }
                catch ( Exception $exc )
                {
                    $exc = null;
                    throw $e; //throw the original error
                }
            }
        }
    }

    /**
     * Export as SVG to image document using inkscape.
     *
     * It will save a temporary file on default system tempo folder.
     *
     * @param string $filename try to use complete path. Works better.
     * @param integer $width
     * @param integer $height
     *
     * @return boolean ?
     */
    public function exportInkscape( $filename, $width = null, $height = null )
    {
        include_once 'inkscape.php'; //support export using inkscape

        $format = SVGDocument::getFileExtension( $filename );
        $inkscape = new Inkscape( $this );
        $inkscape->setSize( $width, $height );

        return $inkscape->export( $format, $filename );
    }

    /**
     * Export to a image file, consider file extension
     * Uses imageMagick
     *
     * @param string $filename
     * @param integer $width the width of exported image
     * @param integer $height the height of exported image
     * @param boolean $respectRatio respect the ratio, image proportion
     */
    public function exportImagick( $filename, $width = null, $height = null, $respectRatio = false )
    {
        if ( !class_exists( 'Imagick' ) )
        {
            throw new Exception( 'Imagemagick class not found. Please install it.' );
        }

        $image = new Imagick();

        $ok = $image->readImageBlob( $this->asXML() );

        if ( $ok )
        {
            if ( $width && $height )
            {
                $image->thumbnailImage( $width, $height, $respectRatio );
            }

            $image->writeImage( $filename );

            $ok = true;
        }

        return $ok;
    }

}

?>
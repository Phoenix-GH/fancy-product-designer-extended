<?php

/**
 *
 * Description: Extends SimpleXMlElement funcionalities
 *
 * Blog: http://trialforce.nostaljia.eng.br
 *
 * Started at Mar 11, 2010
 *
 * @version 0.1
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
class XmlElement extends SimpleXMLElement
{

    /**
     * Value used to control last used id
     *
     * @var integer
     */
    protected static $uniqueId = 0;

    /**
     * Define if is to generate identificator automagic
     *
     * @var boolean if is to generate identificator automagic
     */
    public static $useAutoId = true;

    /**
     * Remove a attribute
     *
     * @param string $attribute name of attribute
     */
    public function removeAttribute( $attribute )
    {
        unset( $this->attributes()->$attribute );
    }

    /**
     * Define an attribute, differs from addAttribute.
     * Define overwrite existent attribute
     *
     * @param string $attribute attribute to set
     * @param string $value value to set
     * @param string $namespace the namespace of attribute
     *
     * @example  $this->addAttribute("xlink:href", $filename, 'http://www.w3.org/1999/xlink');
     */
    public function setAttribute( $attribute, $value, $namespace = null )
    {
        $this->removeAttribute( $attribute );
        $this->addAttribute( $attribute, $value, $namespace );
    }

    /**
     * Return a value of a attribute. Support namespaces using namespace:attribute
     *
     * @param string $attribute
     * @return string return the value of passed attribute
     * @example $svg->g->image->getAttribute('xlink:href')
     */
    public function getAttribute( $attribute )
    {
        $explode = explode( ":", $attribute );

        if ( count( $explode ) > 1 )
        {
            $attributes = $this->attributes( $explode[ 0 ], true );

            //if the attribute exits with namespace return it
            if ( $attributes[ $explode[ 1 ] ] )
            {
                return $attributes[ $explode[ 1 ] ];
            }
            else
            {
                //otherwize will return the attribute without namespaces
                $attribute = $explode[ 1 ];
            }
        }

        return $this->attributes()->$attribute . '';
    }

    /**
     * Define identificator of element
     *
     * @param string $id
     */
    public function setId( $id )
    {
        if ( self::$useAutoId )
        {
            $id = $id ? $id : $this->getUniqueId();
        }

        $this->setAttribute( 'id', $id );
    }

    /**
     * Return identificator of element
     *
     * @return string identificator of element
     */
    public function getId()
    {
        return $this->getAttribute( 'id' );
    }

    /**
     * Returns a unique, never used before  identificator, Inkscape like.
     *
     * @return string a unique, never used before  identificator
     */
    public function getUniqueId()
    {
        return $this->getName() . self::$uniqueId++;
    }

    /**
     * Append other XMLElement, support namespaces.
     *
     * @param XmlElement $append
     */
    public function append( $append )
    {
        //if ( $append ) not working for 'defs'
        if ( isset( $append ) )
        {
            //list all namespaces used in append object
            $namespaces = $append->getNameSpaces();

            //get all childs
            if ( strlen( trim( ( string ) $append ) ) == 0 )
            {
                $xml = $this->addChild( $append->getName(), ' ' );

                foreach ( $append->children() as $child )
                {
                    $xml->append( $child );
                }
            }
            else
            {
                //add one child
                $xml = $this->addChild( $append->getName(), ( string ) $append . ' ' );
            }

            //add simple attributes
            foreach ( $append->attributes() as $attribute => $value )
            {
                $xml->addAttribute( $attribute, $value );
            }

            //add attributes with namespace example xlink:href
            foreach ( $namespaces as $index => $namespace )
            {
                foreach ( $append->attributes( $namespace ) as $attribute => $value )
                {
                    $xml->addAttribute( $index . ':' . $attribute, $value, $namespace );
                }
            }
        }
    }

    /**
     * Find an element using it's id.
     * This function will return only one element, the first
     *
     * @param string $id the id to find
     * @return XmlElement
     */
    public function getElementById( $id )
    {
        return $this->getElementByAttribute( 'id', $id );
    }

    /**
     * Return the first element using the attribute and value passed.
     * Recursive method.
     *
     * @param string $attribute
     * @param string $value
     * @return XmlElement
     */
    public function getElementByAttribute( $attribute, $value )
    {
        if ( $this->getAttribute( $attribute ) == $value )
        {
            return $this;
        }
        else
        {
            if ( count( $this->children() ) > 0 )
            {
                foreach ( $this->children() as $child )
                {
                    $element = $child->getElementByAttribute( $attribute, $value );

                    if ( $element )
                    {
                        return $element;
                    }
                }
            }
        }

        return null;
    }

    /**
     * Recursive function that search elements that match the condition.
     * Return an array of XmlElement.
     *
     * @param string $attribute the attribute to search
     * @param string $value the value to search
     * @param string $condition possible values ==, != , >, >=, <, <=
     * @return array array of XmlElement
     */
    public function getElementsByAttribute( $attribute, $value, $condition = '==' )
    {
        $result = array( );

        if ( $condition == '==' )
        {
            //treat the empty condition
            if ( $value == '' )
            {
                if ( !$this->getAttribute( $attribute ) )
                {
                    $result[ ] = $this;
                }
            }

            if ( $this->getAttribute( $attribute ) == $value )
            {
                $result[ ] = $this;
            }
        }
        else if ( $condition == '!=' )
        {
            if ( $this->getAttribute( $attribute ) != $value )
            {
                $result[ ] = $this;
            }
        }
        else if ( $condition == '>' )
        {
            if ( $this->getAttribute( $attribute ) > $value )
            {
                $result[ ] = $this;
            }
        }
        else if ( $condition == '>=' )
        {
            if ( $this->getAttribute( $attribute ) >= $value )
            {
                $result[ ] = $this;
            }
        }
        else if ( $condition == '<' )
        {
            if ( $this->getAttribute( $attribute ) < $value )
            {
                $result[ ] = $this;
            }
        }
        else if ( $condition == '<=' )
        {
            if ( $this->getAttribute( $attribute ) <= $value )
            {
                $result[ ] = $this;
            }
        }
        else
        {
            if ( $this->count() > 0 )
            {
                foreach ( $this->children() as $line => $child )
                {
                    $element = $child->getElementsByAttribute( $attribute, $value );

                    if ( $element )
                    {
                        $result[ ] = $element;
                    }
                }
            }
        }

        return $result;
    }

    /**
     * Define the title of the shape
     *
     * The first title element will be considered as document title.
     *
     * Is defined as alternative text in browser.
     *
     * @param string $title
     */
    public function setTitle( $title )
    {
        if ( !$this->title )
        {
            $this->addChild( 'title', $title );
        }
        else
        {
            $this->title = $title;
        }
    }

    /**
     * Return the title of element
     *
     * @return string the title of element
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Define the description of the element
     * @param string $desc
     */
    public function setDescription( $desc )
    {
        if ( !$this->desc )
        {
            $this->addChild( 'desc', $desc );
        }
        else
        {
            $this->desc = $desc;
        }
    }

    /**
     * Return the description of element
     *
     * @return string the description of element
     */
    public function getDescription()
    {
        return $this->desc;
    }

    /**
     * Returns s formated xml
     *
     * @param   string $xml the xml text to format
     * @param   boolean $debug set to get debug-prints of RegExp matches
     * @returns string formatted XML
     * @copyright TJ
     * @link kml.tjworld.net
     * @link http://forums.devnetwork.net/viewtopic.php?p=213989
     * @link http://recursive-design.com/blog/2007/04/05/format-xml-with-php/
     */
    protected function prettyXML( $xml )
    {
        // add marker linefeeds to aid the pretty-tokeniser
        // adds a linefeed between all tag-end boundaries
        $xml = preg_replace( '/(>)(<)(\/*)/', "$1\n$2$3", $xml );

        // now pretty it up (indent the tags)
        $tok = strtok( $xml, "\n" );
        $formatted = ''; // holds pretty version as it is built
        $pad = 0; // initial indent
        $matches = array( ); // returns from preg_matches()

        /*
         * pre- and post- adjustments to the padding indent are made, so changes can be applied to
         * the current line or subsequent lines, or both
         */
        while ( $tok !== false )// scan each line and adjust indent based on opening/closing tags
        {
            // test for the various tag states
            if ( preg_match( '/.+<\/\w[^>]*>$/', $tok, $matches ) )// open and closing tags on same line
            {
                $indent = 0; // no change
            }
            else if ( preg_match( '/^<\/\w/', $tok, $matches ) ) // closing tag
            {
                $pad--; //  outdent now
            }
            else if ( preg_match( '/^<\w[^>]*[^\/]>.*$/', $tok, $matches ) )// opening tag
            {
                $indent = 1; // don't pad this one, only subsequent tags
            }
            else
            {
                $indent = 0; // no indentation needed
            }

            // pad the line with the required number of leading spaces
            $prettyLine = str_pad( $tok, strlen( $tok ) + $pad, ' ', STR_PAD_LEFT );
            $formatted .= $prettyLine . "\n"; // add to the cumulative result, with linefeed
            $tok = strtok( "\n" ); // get the next token
            $pad += $indent; // update the pad size for subsequent lines
        }

        return $formatted; // pretty format
    }

    public function asXML( $filename = null, $humanReadable = true )
    {
        if ( $filename )
        {
            parent::asXML( $filename );
        }
        else
        {
            //define if xml is humanReadable or not
            if ( $humanReadable )
            {
                return $this->prettyXML( parent::asXML() );
            }
            else
            {
                return parent::asXML();
            }
        }
    }

    /**
     * Remove an element by it's id.
     *
     * @param string $id
     */
    public function removeElementById( $id )
    {
        $this->removeElement( $this->getElementById( $id ) );
    }

    public function removeElement( $node )
    {
        $dom = dom_import_simplexml( $node );
        $dom->parentNode->removeChild( $dom );
    }

}

#create the function if it not exists php < 5.3
if ( !function_exists( 'mime_content_type' ) )
{

    function mime_content_type( $filename )
    {
        //TODO need better list
        $mime_types = array(
            'txt'  => 'text/plain',
            'htm'  => 'text/html',
            'html' => 'text/html',
            'php'  => 'text/html',
            'css'  => 'text/css',
            'js'   => 'application/javascript',
            'json' => 'application/json',
            'xml'  => 'application/xml',
            'swf'  => 'application/x-shockwave-flash',
            'flv'  => 'video/x-flv',
            // images
            'png'  => 'image/png',
            'jpe'  => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'jpg'  => 'image/jpeg',
            'gif'  => 'image/gif',
            'bmp'  => 'image/bmp',
            'ico'  => 'image/vnd.microsoft.icon',
            'tiff' => 'image/tiff',
            'tif'  => 'image/tiff',
            'svg'  => 'image/svg+xml',
            'svgz' => 'image/svg+xml',
            // archives
            'zip'  => 'application/zip',
            'rar'  => 'application/x-rar-compressed',
            'exe'  => 'application/x-msdownload',
            'msi'  => 'application/x-msdownload',
            'cab'  => 'application/vnd.ms-cab-compressed',
            // audio/video
            'mp3'  => 'audio/mpeg',
            'qt'   => 'video/quicktime',
            'mov'  => 'video/quicktime',
            // adobe
            'pdf'  => 'application/pdf',
            'psd'  => 'image/vnd.adobe.photoshop',
            'ai'   => 'application/postscript',
            'eps'  => 'application/postscript',
            'ps'   => 'application/postscript',
            // ms office
            'doc'  => 'application/msword',
            'rtf'  => 'application/rtf',
            'xls'  => 'application/vnd.ms-excel',
            'ppt'  => 'application/vnd.ms-powerpoint',
            // open office
            'odt'  => 'application/vnd.oasis.opendocument.text',
            'ods'  => 'application/vnd.oasis.opendocument.spreadsheet',
        );

        $ext = explode( '.', $filename );
        $ext = strtolower( array_pop( $ext ) );

        if ( array_key_exists( $ext, $mime_types ) )
        {
            return $mime_types[ $ext ];
        }
        elseif ( function_exists( 'finfo_open' ) )
        {
            $finfo = finfo_open( FILEINFO_MIME );
            $mimetype = finfo_file( $finfo, $filename );
            finfo_close( $finfo );
            return $mimetype;
        }
        else
        {
            return 'application/octet-stream';
        }
    }

}
?>
<?php
/*
 *
 * Description: Interface with command-line Inkscape
 * While obviously Inkscape is primarily intended as a GUI application,
 * it can be used for doing SVG processing on the command line as well.
 *
 * @link http://trialforce.nostaljia.eng.br
 * @link http://www.w3.org/TR/SVG/
 *
 * Started at Mar 11, 2010
 *
 * @version 0.1
 *
 * @author Eduardo Bonfandini
 *
 * Inkscape is a GUI editor for Scalable Vector Graphics (SVG) format drawing files,
 * with capabilities similar to Adobe Illustrator, CorelDraw, Xara Xtreme, etc. Inkscape features
 * include versatile shapes, bezier paths, freehand drawing, multi-line text, text on path,
 * alpha blending, arbitrary affine transforms, gradient and pattern fills, node editing, many
 * export and import formats including PNG and PDF, grouping, layers, live clones, and a lot more.
 * The interface is designed to be comfortable and efficient for skilled users, while
 * remaining conformant to GNOME standards so that
 * users familiar with other GNOME applications can learn its interface rapidly.
 *
 * SVG is a W3C standard XML format for 2D vector drawing.
 * It allows defining objects in the drawing using points, paths, and primitive shapes.
 * Colors, fonts, stroke width, and so forth are specified as `style' attributes to these objects.
 * The intent is that since SVG is a standard, and since its files are text/xml,
 * it will be possible to use SVG files in a sizeable number of programs and for a wide range of uses.
 *
 * Inkscape uses SVG as its native document format,
 * and has the goal of becoming the most fully compliant drawing program for SVG files available in the Open Source community.
 *
 * List of not implement options:
 *
 *           -a, --export-area=x0:y0:x1:y1
 *           -C, --export-area-page
 *           -D, --export-area-drawing
 *               --export-area-snap
 *           -t, --export-use-hints
 *               --export-latex
 *               --export-ignore-filters
 *           -p, --print=PRINTER
 *           -X, --query-x
 *           -Y, --query-y
 *           -W, --query-width
 *           -H, --query-height
 *           -S, --query-all
 *           -x, --extension-directory
 *              --verb-list
 *              --verb=VERB-ID
 *              --select=OBJECT-ID
 *              --shell
 *              --vacuum-defs
 *              --g-fatal-warnings
 *
 * OPTIONS
 *
 *       -a x0:y0:x1:y1, --export-area=x0:y0:x1:y1
 *              In PNG export, set the exported area in SVG user units (anonymous length units normally used in Inkscape SVG).  The default is to export the entire document page.  The
 *              point (0,0) is the lower-left corner.
 *
 *       -C, --export-area-page
 *              In PNG, PDF, PS, and EPS export, exported area is the page. This is the default for PNG, PDF, and PS, so you don't need to specify this unless you are using --export-id to
 *              export a specific object. In EPS, however, this is not the default; moreover, for EPS, the specification of the format does not allow its bounding box to extend beyond its
 *              content.  This means that when --export-area-page is used with EPS export, the page bounding box will be trimmed inwards to the bounding box of the content if it is
 *              smaller.
 *
 *       -D, --export-area-drawing
 *              In PNG, PDF, PS, and EPS export, exported area is the drawing (not page), i.e. the bounding box of all objects of the document (or of the exported object if --export-id is
 *              used).  With this option, the exported image will display all the visible objects of the document without margins or cropping. This is the default export area for EPS. For
 *              PNG, it can be used in combination with --export-use-hints.
 *
 *
 *       -x, --extension-directory
 *              Lists the current extension directory that Inkscape is configured to use and then exits.  This is used for external extension to use the same configuration as the original
 *              Inkscape installation.
 *
 *       --verb-list
 *              Lists all the verbs that are available in Inkscape by ID.  This ID can be used in defining keymaps or menus.  It can also be used with the --verb command line option.
 *
 *       --verb=VERB-ID, --select=OBJECT-ID
 *              These two options work together to provide some basic scripting for Inkscape from the command line.  They both can occur as many times as needed on the command line and are
 *              executed in order on every document that is specified.
 *
 *              The --verb command will execute a specific verb as if it was called from a menu or button.  Dialogs will appear if that is part of the verb.  To get a list of the verb IDs
 *              available, use the --verb-list command line option.
 *
 *              The --select command will cause objects that have the ID specified to be selected.  This allows various verbs to act upon them.  To remove all the selections use
 *              --verb=EditDeselect.  The object IDs available are dependent on the document specified to load.
 *
 *       -p PRINTER, --print=PRINTER
 *                             Print document(s) to the specified printer using `lpr -P PRINTER'.  Alternatively, use `| COMMAND' to specify a different command to pipe to, or use `> FILENAME' to write
 *               the PostScript output to a file instead of printing.  Remember to do appropriate quoting for your shell, e.g.
 *
 *               inkscape --print='| ps2pdf - mydoc.pdf' mydoc.svg
 *
 *       -t, --export-use-hints
 *               Use export filename and DPI hints stored in the exported object (only with --export-id).  These hints are set automatically when you export selection from within Inkscape.
 *               So, for example, if you export a shape with id="path231" as /home/me/shape.png at 300 dpi from document.svg using Inkscape GUI, and save the document, then later you will
 *               be able to reexport that shape to the same file with the same resolution simply with
 *
 *               inkscape -i path231 -t document.svg
 *
 *               If you use --export-dpi, --export-width, or --export-height with this option, then the DPI hint will be ignored and the value from the command line will be used.  If you
 *               use --export-png with this option, then the filename hint will be ignored and the filename from the command line will be used.
 *
 *
 *       --export-latex
 *               (for PS, EPS, and PDF export) Used for creating images for LaTeX documents, where the image's text is typeset by LaTeX.  When exporting to PDF/PS/EPS format, this option
 *               splits the output into a PDF/PS/EPS file (e.g. as specified by --export-pdf) and a LaTeX file. Text will not be output in the PDF/PS/EPS file, but instead will appear in
 *               the LaTeX file. This LaTeX file includes the PDF/PS/EPS. Inputting (\input{image.tex}) the LaTeX file in your LaTeX document will show the image and all text will be
 *               typeset by LaTeX. See the resulting LaTeX file for more information.  Also see GNUPlot's `epslatex' output terminal.
 *
 *       --export-ignore-filters
 *               Export filtered objects (e.g. those with blur) as vectors, ignoring the filters (for PS, EPS, and PDF export).  By default, all filtered objects are rasterized at
 *               --export-dpi (default 90 dpi), preserving the appearance.
 *
 *       -X, --query-x
 *               Query the X coordinate of the drawing or, if specified, of the object with --query-id. The returned value is in px (SVG user units).
 *
 *      -Y, --query-y
 *               Query the Y coordinate of the drawing or, if specified, of the object with --query-id. The returned value is in px (SVG user units).
 *
 *       -W, --query-width
 *               Query the width of the drawing or, if specified, of the object with --query-id. The returned value is in px (SVG user units).
 *
 *       -H, --query-height
 *               Query the height of the drawing or, if specified, of the object with --query-id. The returned value is in px (SVG user units).
 *
 *       -S, --query-all
 *               Prints a comma delimited listing of all objects in the SVG document with IDs defined, along with their x, y, width, and height values.
 *
 *       --shell With this parameter, Inkscape will enter an interactive command line shell mode. In this mode, you type in commands at the prompt and Inkscape executes them, without you
 *               having to run a new copy of Inkscape for each command. This feature is mostly useful for scripting and server uses: it adds no new capabilities but allows you to improve
 *               the speed and memory requirements of any script that repeatedly calls Inkscape to perform command line tasks (such as export or conversions). Each command in shell mode
 *               must be a complete valid Inkscape command line but without the Inkscape program name, for example "file.svg --export-pdf=file.pdf".
 *
 *       --vacuum-defs
 *               Remove all unused items from the <lt>defs<gt> section of the SVG file.  If this option is invoked in conjunction with --export-plain-svg, only the exported file will be
 *               affected.  If it is used alone, the specified file will be modified in place.
 *
 *       --g-fatal-warnings
 *               This standard GTK option forces any warnings, usually harmless, to cause Inkscape to abort (useful for debugging).
 *
 *       --usage Display a brief usage message.
 *
 * EXAMPLES
 *       While obviously Inkscape is primarily intended as a GUI application, it can be used for doing SVG processing on the command line as well.
 *
 *       Print an SVG file from the command line:
 *
 *           inkscape filename.svg -p '| lpr'
 *
 *       Same, but force the PNG file to be 600x400 pixels:
 *
 *           inkscape filename.svg --export-png=filename.png -w600 -h400
 *
 *       Same, but export the drawing (bounding box of all objects), not the page:
 *
 *           inkscape filename.svg --export-png=filename.png --export-area-drawing
 *
 *       Export to PNG the object with id="text1555", using the output filename and the resolution that were used for that object last time when it was exported from the GUI:
 *
 *           inkscape filename.svg --export-id=text1555 --export-use-hints
 *
 *       Same, but use the default 90 dpi resolution, specify the filename, and snap the exported area outwards to the nearest whole SVG user unit values (to preserve pixel-alignment of
 *       objects and thus minimize aliasing):
 *
 *           inkscape filename.svg --export-id=text1555 --export-png=text.png --export-area-snap
 *
 *       Convert an SVG document to EPS, converting all texts to paths:
 *
 *         inkscape filename.svg --export-eps=filename.eps --export-text-to-path
 *
 *       Query the width of the object with id="text1555":
 *
 *           inkscape filename.svg --query-width --query-id text1555
 *
 *       Duplicate the object with id="path1555", rotate the duplicate 90 degrees, save SVG, and quit:
 *
 *           inkscape filename.svg --select=path1555 --verb=EditDuplicate --verb=ObjectRotate90 --verb=FileSave --verb=FileClose
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
 *
 * Implemented for Inkscape-0.48.0
 */
class Inkscape
{
    /**
     * exec params.
     *
     * @var array
     */
    protected $params;
    /**
     * Last execute result string.
     * 
     * @var string
     */
    protected $lastExecuteResult;
    protected $lastCmd;

    public function __construct( $filename )
    {
        //treat if is a SVGDocument
        if ( $filename instanceof SVGDocument )
        {
            $tmpFileName =  sys_get_temp_dir().'tmp.svg';
            $filename->asXML($tmpFileName, false );
            $filename = $tmpFileName;
        }

        $this->addParam( 'without-gui' );
        $this->setFile( $filename );
    }

    public function addParam( $param, $value = NULL )
    {
        if ( $param )
        {
            $this->params[$param] = $value;
        }
    }

    public function setParam( $param, $value = NULL )
    {
        $this->clearParams();
        $this->params[$param] = $value;
    }

    public function getParam( $param )
    {
        return $this->params[$param];
    }

    public function getParams()
    {
        return $this->params;
    }

    public function setParams( $params )
    {
        return $this->params = $params;
    }

    public function clearParams()
    {
        $this->params = null;
    }

    /**
     * Define the size of the resulting image
     * The width of generated bitmap in pixels.
     * This value overrides the --export-dpi setting (or the DPI hint if used with --export-use-hints).
     *
     * @param integer $width
     * @param integer $height
     */
    public function setSize( $width, $height )
    {
        if ( $width )
        {
            $this->addParam( 'export-width', $width );
        }

        if ( $height )
        {
            $this->addParam( 'export-height', $width );
        }
    }

    /**
     *
     * Background color of exported PNG.
     * This may be any SVG supported color string, for example "#ff007f" or "rgb(255, 0, 128)".
     * If not set, then the page color set in Inkscape
     * in the Document Options dialog will be used (stored in the pagecolor= attribute of sodipodi:namedview).
     *
     * @param string $color
     * @param string $opacity
     */
    public function setBackground( $color, $opacity = null )
    {
        $this->addParam( 'export-background', $color );

        if ( $opacity )
        {
            $this->addParam( 'export-background-opacity', $opacity );
        }
    }

    /**
     * Define the quality of resulting image, only used in PNG export.
     *
     * @param integer $dpi the quality of resulting image
     */
    public function setDpi( $dpi )
    {
        $this->addParam( 'export-dpi', $dpi );
    }

    /*
     *Define to export the total page area
     */
    public function setExportAreaPage()
    {
        $this->addParam('export-area-page');
    }

    /**
     * Convert text objects to paths on export, where applicable (for PS, EPS, and PDF export).
     */
    public function exportTextToPath()
    {
        $this->addParam( 'export-text-to-path' );
    }

    /**
     * For PNG export, snap the export area outwards to the nearest integer SVG user unit (px) values.
     * If you are using the default export resolution of 90 dpi and your graphics
     * are pixel-snapped to minimize antialfiasing, this switch allows you to preserve this alignment
     * even if you are exporting some object's bounding box (with --export-id or
     * --export-area-drawing) which is itself not pixel-aligned.
     */
    public function exportAreaSnap()
    {
        $this->addParam( 'export-area-snap' );
    }

    /**
     * Show help message ( -?, --help )
     *
     * @return string
     */
    public function getHelp()
    {
        $tmpParams = $this->getParams();
        $this->setParam( 'help' );
        $exec = $this->execute();
        $this->setParams( $tmpParams );

        return $exec;
    }

    /**
     * Display a brief usage message. --usage
     * 
     * @return string
     * 
     */
    public function getUsage()
    {
        $tmpParams = $this->getParams();
        $this->setParam( 'usage' );
        $exec = $this->execute();
        $this->setParams( $tmpParams );

        return $exec;
    }

    /**
     *
     * Show Inkscape version and build date.
     * 
     * -V, --version
     *
     * @return the version of inkscape
     */
    public function getVersion()
    {
        $tmpParams = $this->getParams();
        $this->setParam( 'version' );
        $exec = $this->execute();
        $this->setParams( $tmpParams );

        return $exec;
    }

    /**
     * 
     * Open specified document(s).
     * Option string may be omitted, i.e. you can list the filenames without -f.
     *
     * @param string $filename
     */
    public function setFile( $filename )
    {
        if ( $filename )
        {
            $this->addParam( 'file', $filename );
        }
    }

    /**
     * Set the ID of the object whose dimensions are queried.
     * If not set, query options will return the dimensions of the drawing (i.e. all document objects),
     * not the page or viewbox
     *
     * Only export to PNG the object whose id is given in --export-id.
     * All other objects are hidden and won't show in export even if they overlay the exported object.
     * Without --export-id, this option is ignored
     * 
     * @param string $id
     * @param boolean All other objects are hidden and won't show in export even if they overlay the exported object.
     */
    public function setExportId( $id, $exportIdOnly = false )
    {
        if ( $exportIdOnly )
        {
            $this->addParam( 'export-id-only' );
        }

        $this->addParam( 'export-id', $id );
    }

    /**
     * Specify the filename to export.
     * If it already exists, the file will be overwritten without asking.
     * Available formats: png,ps,eps,pdf,plain-svg
     *
     * @param string $format format to export
     * @param string $filename
     * @return string
     *
     */
    public function export( $format, $filename )
    {
        if ( !$format )
        {
            throw new Exception( 'Need to inform a format.' );
        }

        if ( !$filename )
        {
            throw new Exception( 'Need to inform a file path to save.' );
        }

        $availableFormat = array( 'png', 'ps', 'eps', 'pdf', 'plain-svg' );

        if ( in_array( $format, $availableFormat ) )
        {
            $this->addParam( 'export-' . $format, $filename );
            $this->execute();

            if ( file_exists( $filename ) )
            {
                return true;
            }
            else
            {
                $msg = '';

                if ( !defined( 'INKSCAPE_PATH' ) )
                {
                    $msg = ' Define INKSCAPE_PATH is not defined. Try to define it.';
                }

                throw new Exception( 'Impossible to save file in path : ' . $filename . PHP_EOL . '  Inkcape cmd: ' . $this->lastCmd . PHP_EOL . 'Inkscape Error Message = ' . $this->lastExecuteResult . $msg );
            }
        }
        else
        {
            throw new Exception( 'Format not available:' . $format . '.' );
        }
    }

    /**
     * Return the last execute result string
     * 
     * @return string
     */
    public function getLastExecuteResult()
    {
        return $this->lastExecuteResult;
    }
    
    /**
     * Returns the last executed cmd
     * 
     * @return string
     */
    public function getLastCmd()
    {
        return $this->lastCmd;
    }

    /**
     * Execute the inkscape.
     *
     * @param string some extra content for exec command
     *
     * @return string
     */
    public function execute( $extraParam = null )
    {
        if ( defined( 'INKSCAPE_PATH' ) )
        {
            $exec = INKSCAPE_PATH;
        }
        else
        {
            $exec = 'inkscape';
        }

        if ( is_array( $this->params ) )
        {
            foreach ($this->params as $param => $value)
            {
                $exec .= ' --' . $param;

                if ( $value )
                {
                    $exec .= '=' . $value;
                }
            }
        }

        $this->lastCmd = $exec . ' ' . $extraParam;
        $this->lastExecuteResult = shell_exec( $this->lastCmd );

        if ( trim( $this->lastExecuteResult ) == 'Nothing to do!' )
        {
            throw new Exception( 'Nothing to do!' );
        }

        return $this->lastExecuteResult;
    }
}
?>
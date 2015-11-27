<?php
/**
 *
 * Description: Implementation of Style class.
 *
 * Blog: http://trialforce.nostaljia.eng.br
 *
 * Started at Mar 18, 2010
 *
 * @version 0.1
 *
 * @author Eduardo Bonfandini
 *
 *-----------------------------------------------------------------------
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
 *----------------------------------------------------------------------
 */

class SVGStyle
{
    public $fill;
    public $stroke;
    public $strokeWidth;
    public $stopColor;
    public $stopOpacity;
    public $display;
    
    /**
     * Construct the style
     *
     * @param array $style an array with styles
     */
    public function __construct( $style = null )
    {
        if (is_string($style) )
        {
            $style = explode(';', $style);

            if ( is_array($style))
            {
                foreach ( $style as $line => $info )
                {
                    $styleElement = explode(':', $info);

                    if ( $styleElement[0] )
                    {
                        $property = SVGStyle::toCamelCase( $styleElement[0]);
                        $this->{$property} = $styleElement[1];
                    }
                }
            }
        }
        else if ( is_array($style) )
        {
            foreach ( $style as $line => $info )
            {
                $this->$line = $info;
            }
        }
    }

    /**
     * Return the string representation of object
     *
     * @return string representation of object
     */
    public function __toString()
    {
        $vars = get_object_vars($this);
        $result = '';

        if ( is_array($vars) )
        {
            foreach ( $vars as $line => $info )
            {
                if ( isset($info) )
                {
                    $line  = SVGStyle::fromCamelCase( $line );
                    $result .= "$line:$info;";
                }
            }
        }

        return $result;
    }
    
    /**
     * Define the display of elemet
     * 
     * @param string $display
     */
    public function setDisplay($display)
    {
        $this->display = $display;
    }
    
    /**
     * Return the display of element
     * @return string
     */
    public function getDisplay()
    {
        return $this->display;
    }
    
    /**
     * Show the element
     */
    public function show()
    {
        $this->display = 'inline';
    }
    
    /**
     * Hide the element
     */
    public function hide()
    {
        $this->display = 'none';
    }

    /**
     * Set the fill color
     *
     * @param string $fill color
     */
    public function setFill($fill)
    {
        if ( $fill instanceof SVGLinearGradient )
        {
            $fill = $this->url( $fill );
        }
        
        $this->fill = $fill;
    }

    /**
     * Get the fill color
     * 
     * @return string fill color
     */
    public function getFill()
    {
        return $this->fill;
    }

    /**
     * Set the stroke (contour) color
     *
     * @param string $stroke the stroke color
     */
    public function setStroke($stroke, $width = null )
    {
        $this->stroke = $stroke;
        
        $this->setStrokeWidth($width);
    }
    
    /**
     * Define the width of the stroke
     * 
     * @param integer $width width of the stroke
     */ 
    public function setStrokeWidth( $width )
    {
        if ( $width )
        {
            $this->strokeWidth = $width;
        }
    }
    
    /**
     * Return the stroke width
     * 
     * @return type integer
     */
    public function getStrokeWidth()
    {
        return $this->strokeWidth;
    }

    /**
     * Return the stroke (contour) color
     *
     * @return string
     */
    public function getStroke( )
    {
        return $this->stroke;
    }

    /**
     * Make the url in some param
     *
     * @param XmlElement or string $content
     *
     * @return string
     */
    public function url( $content )
    {
        $url = $content;
        
        if ( $content instanceof XmlElement )
        {
            $url = '#'.$content->getId();
        }
        
        return "url({$url})";
    }

    /**
     * Make a not camelCase version of string
     *
     * http://www.paulferrett.com/2009/php-camel-case-functions/
     *
     * stopColor turns stop-color
     *
     * @param string $str
     * @return string the new string
     */
    protected static function fromCamelCase($str)
    {
        $str[0] = strtolower($str[0]);
        return preg_replace('/([A-Z])/e', "'-' . strtolower('\\1')", $str);
    }

    /**
     * Converts a string to camelCase
     *
     * stop-color turns stopColor 
     *
     * @param string $str
     * @return string
     */
    protected static function toCamelCase($str)
    {
        return preg_replace('/-([a-z])/e', "strtoupper('\\1')", $str);
    }
}
?>

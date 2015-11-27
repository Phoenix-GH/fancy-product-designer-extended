<?php
/**
 *
 * Description: Implementation of Shape, is a generic class with basic shape functions.
 *
 * Blog: http://trialforce.nostaljia.eng.br
 *
 * Started at Mar 11, 2010
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

class SVGShape extends XMLElement
{
    const TRANSFORM_SEPARATOR = ' ';

    /**
     * Define the x coordinate of position
     *
     * @param float $x the x coordinate of position
     */
    public function setX( $x )
    {
        $this->setAttribute( 'x', $x );
    }

    /**
     * Return the x coordinate of position
     *
     * @return float the x coordinate of position
     */
    public function getX()
    {
        return $this->getAttribute( 'x' );
    }

    /**
     * Define the y coordinate of position
     *
     * @param float $y the y coordinate of position
     */
    public function setY( $y )
    {
        $this->setAttribute( 'y', $y );
    }

    /**
     * Return the y coordinate of position
     *
     * @return float the y coordinate of position
     */
    public function getY()
    {
        return $this->getAttribute( 'y' );
    }

    /**
     * Define the style of element, can be a SVGStyle element or an string
     *
     * @param SVGStyle $style SVGStyle element or an string
     */
    public function setStyle( $style )
    {
        if ( !$style )
        {
            $style = new SVGStyle();
        }

        $this->setAttribute( 'style', $style );
    }

    /**
     * Return the style element
     *
     *
     * @return SVGStyle style of element
     */
    public function getStyle()
    {
        return new SVGStyle( $this->getAttribute( 'style') );
    }
    
    /**
     * Show element
     */
    public function show()
    {
        $style = $this->getStyle();
        $style->show();
        $this->setStyle($style);
    }
    
    /**
     * Hide the element
     */
    public function hide()
    {
        $style = $this->getStyle();
        $style->hide();
        $this->setStyle($style);
    }

    /**
     * Return the string with the transformation of shape
     *
     * @return string the transformation of shape
     */
    public function getTransform()
    {
        return $this->getAttribute('transform');
    }

    /**
     *  Return the tranform attribute as a list/array
     *
     * @return array transform dados
     */
    public function getTranformList()
    {
        return explode(self::TRANSFORM_SEPARATOR ,  $this->getTransform() );
    }

    /**
     * Define the transformation of Shape
     *
     * @param string $transform the transformation command
     * @see http://www.w3.org/TR/SVG/coords.html#TransformAttribute
     *
     */
    public function setTransform( $transform )
    {
        $this->setAttribute('transform', $transform );
    }

    /**
     * Add a transformation of Shape
     *
     * @param string $transform the transformation command
     * @see http://www.w3.org/TR/SVG/coords.html#TransformAttribute
     *
     */
    public function addTransform( $transform )
    {
        if ( $this->getTransform() );
        {
            $transform = trim($this->getTransform()) . self::TRANSFORM_SEPARATOR . $transform;
        }
        
        $this->setAttribute( 'transform', $transform );
    }

    /**
     * rotate(<rotate-angle> [<cx> <cy>]), which specifies a rotation by <rotate-angle> degrees about a given point.
     * If optional parameters <cx> and <cy> are not supplied, the rotate is about the origin of the current user coordinate system. The operation corresponds to the matrix [cos(a) sin(a) -sin(a) cos(a) 0 0].
     * If optional parameters <cx> and <cy> are supplied, the rotate is about the point (cx, cy). The operation represents the equivalent of the following specification: translate(<cx>, <cy>) rotate(<rotate-angle>) translate(-<cx>, -<cy>)
     *
     * @param float $angle the rotation angle
     * @param float $cx x of rotation point
     * @param float $cy y of rotation point
     * @see http://www.w3.org/TR/SVG/coords.html#TransformAttribute
     */
    public function rotate($angle, $cx = null, $cy = null )
    {
        if ( $cx && $cy )
        {
            $this->addTransform("rotate($angle,$cx,$cy)");
        }
        else
        {
            $this->addTransform("rotate($angle)");
        }
    }

    /**
     * scale(<sx> [<sy>]), which specifies a scale operation by sx and sy.
     * @param float $sx
     * @param float $sy If <sy> is not provided, it is assumed to be equal to <sx>.
     * @see http://www.w3.org/TR/SVG/coords.html#TransformAttribute
     */
    public function scale( $sx, $sy = null )
    {
        if ( $sx && $sy )
        {
            $this->addTransform( "scale($sx, $sy)" );
        }
        else
        {
            $this->addTransform( "scale($sx)" );
        }
    }

    /*

    /**
     * translate(<tx> [<ty>]), which specifies a translation by tx and ty
     *
     * Move the shape.
     *
     * @param float $tx translate x
     * @param float $ty translate y If <ty> is not provided, it is assumed to be zero
     */
    public function translate( $tx, $ty = null )
    {
        if ( $ty )
        {
            $this->addTransform("translate($tx,$ty)");
        }
        else
        {
            $this->addTransform("translate($tx);");
        }
    }

    /**
     * skewX(<skew-angle>), which specifies a skew transformation along the x-axis.
     *
     * @param float $angle the skewX angle
     */
    public function skewX($angle)
    {
         $this->addTransform( "skewX($angle)" );
    }

    /**
     * skewY(<skew-angle>), which specifies a skew transformation along the y-axis.
     *
     * @param float $angle the skewY angle
     */
    public function skewY($angle)
    {
         $this->addTransform( "skewY($angle)" );
    }

    /**
     * matrix(<a> <b> <c> <d> <e> <f>), which specifies a transformation in the form of a transformation matrix of six values.
     * matrix(a,b,c,d,e,f) is equivalent to applying the transformation matrix [a b c d e f].
     *
     * @param float $a
     * @param float $b
     * @param float $c
     * @param float $d
     * @param float $e
     * @param float $f
     */
    public function matrix( $a, $b, $c, $d, $e, $f )
    {
        $this->addTransform( "matrix($a,$b,$c,$d,$e,$f)" );
    }
    
    /**
     * Define the script execute on click in this shape
     * 
     * @param text $script
     */
    public function addOnclick($script)
    {
        $this->addAttribute('onclick', $script );
    }
    
    /**
     * Define the script execute on focus in
     * 
     * @param text $script
     */
    public function addOnFocusIn($script)
    {
        $this->addAttribute('onfocusin', $script );
    }
    
    /**
     * Define the script execute on focus out
     * 
     * @param text $script
     */
    public function addOnFocusOut($script)
    {
        $this->addAttribute('onfocusout', $script );
    }
    
    /**
     * Define the script execute on active
     * 
     * @param text $script
     */
    public function addOnActivate($script)
    {
        $this->addAttribute('onactivate', $script );
    }
    
    /**
     * Define the script execute on mouse down
     * 
     * @param text $script
     */
    public function addOnMouseDown($script)
    {
        $this->addAttribute('onmousedown', $script );
    }
    
    /**
     * Define the script execute on mouse up
     * 
     * @param text $script
     */
    public function addOnMouseUp($script)
    {
        $this->addAttribute('onmouseup', $script );
    }
    
    /**
     * Define the script execute on mouse over
     * 
     * @param text $script
     */
    public function addOnMouseOver($script)
    {
        $this->addAttribute('onmouseover', $script );
    }
    
    /**
     * Define the script execute on mouse move
     * 
     * @param text $script
     */
    public function addOnMouseMove($script)
    {
        $this->addAttribute('onmousemove', $script );
    }
    
    /**
     * Define the script execute on mouse out
     * 
     * @param text $script
     */
    public function addOnMouseOut($script)
    {
        $this->addAttribute('onmouseout', $script );
    }
}
?>

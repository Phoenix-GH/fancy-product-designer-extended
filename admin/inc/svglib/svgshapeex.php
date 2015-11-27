<?php
/**
 *
 * Description: Implementation of ShapeEx, it is a shape with width.
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

class SVGShapeEx extends SVGShape
{
    /**
     * Define the width of the object
     *
     * @param integer $width
     */
    public function setWidth( $width )
    {
        $this->setAttribute( 'width', $width );
    }

    /**
     * Return the width of element
     *
     * @return integer the width of element
     */
    public function getWidth()
    {
        return $this->getAttribute( 'width' );
    }

    /**
     * Define the height of the object
     *
     * @param integer $height
     */
    public function setHeight( $height )
    {
        $this->setAttribute( 'height', $height );
    }

    /**
     * Return the height of element
     *
     * @return integer the height of element
     */
    public function getHeight()
    {
        return $this->getAttribute( 'height' );
    }
}
?>
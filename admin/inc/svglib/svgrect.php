<?php
/**
 *
 * Description: Implementation of Rect.
 *
 * Blog: http://trialforce.nostaljia.eng.br
 *
 * Started at Mar 11, 2010
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
 *   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.   See the
 *   GNU Library General Public License for more details.
 *
 *   You should have received a copy of the GNU Library General Public
 *   License along with this program; if not, access
 *   http://www.fsf.org/licensing/licenses/lgpl.html or write to the
 *   Free Software Foundation, Inc., 675 Mass Ave, Cambridge, MA 02139, USA.
 *----------------------------------------------------------------------
 */
class SVGRect extends SVGShapeEx
{
    public static function getInstance( $x, $y, $id, $width, $height, $style = null )
    {
        $rect = new SVGRect('<rect></rect>');

        $rect->setX( $x );
        $rect->setY( $y );
        $rect->setWidth( $width );
        $rect->setHeight( $height );
        $rect->setId( $id );
        $rect->setStyle($style);

        return $rect;
    }
    
    /**
     * Define the round of rect
     * 
     * @param integer $rx the round
     */
    public function setRound( $rx )
    {
        $this->addAttribute('rx', $rx );
    }
    
    /** 
     * Return the round of rect
     *  
     * @return integer return the round
     */
    public function getRound()
    {
        return $this->getAttribute('rx');
    }
}
?>
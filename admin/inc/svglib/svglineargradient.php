<?php
/**
 *
 * Description: Implementation of Linear Gradient.
 *
 * Blog: http://trialforce.nostaljia.eng.br
 *
 * Started at Aug 1, 2011
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
class SVGLinearGradient extends XmlElement
{
    public static function getInstance( $id, array $stops )
    {
        $gradient = new SVGLinearGradient( '<linearGradient></linearGradient>' );
        $gradient->setId( $id );
        $gradient->setStops( $stops );

        return $gradient;
    }

    /**
     * Add one stop object.
     * Do not control the offset.
     * 
     * @param SVGStop $stop
     */
    public function addStop( SVGStop $stop )
    {
        $this->append( $stop );
    }

    /**
     * Define an array of SVGStop
     *
     * @param array of SVGStop
     */
    public function setStops( $stops )
    {
        if ( is_array( $stops ) )
        {
            //automagic controls the offset
            $offset = 0;
            $stopCount = count( $stops )-1;

            foreach ( $stops as $line => $stop )
            {
                if ( $stop instanceof SVGStop )
                {
                    if ( !$stop->getOffset() )
                    {
                        $c = 1 * ( $offset / $stopCount );
                        $offset++;
                        $stop->setOffset( $c );
                    }

                    $this->addStop( $stop );
                }
            }
        }
    }

    /*public function setX1( $x1 )
    {
        $this->setAttribute('x1',$x1 );
    }

    public function getX1( )
    {
        return $this->getAttribute('x1');
    }

    public function setY1( $y1 )
    {
        $this->setAttribute('y1',$y1 );
    }

    public function getY1( )
    {
        return $this->getAttribute('y1');
    }

    public function setX2( $x2 )
    {
        $this->setAttribute('x2',$x2 );
    }

    public function getX2( )
    {
        return $this->getAttribute('x2');
    }

    public function setY2( $y2 )
    {
        $this->setAttribute('y2',$y2 );
    }

    public function getY2( )
    {
        return $this->getAttribute('y2');
    }*/
}
?>

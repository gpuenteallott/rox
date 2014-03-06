<?php
/*
Copyright (c) 2007-2009 BeVolunteer

This file is part of BW Rox.

BW Rox is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

BW Rox is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, see <http://www.gnu.org/licenses/> or
write to the Free Software Foundation, Inc., 59 Temple Place - Suite 330,
Boston, MA  02111-1307, USA.
*/


/**
 * @author shevek
 */

/**
 * City page
 *
 * @package Apps
 * @subpackage Places
 */
class CityPage extends PageWithActiveSkin
{
    protected function getPageTitle() {
        $words = $this->getWords();
        return $words->getBuffered('Countries') . ' - BeWelcome';
    }

    protected function teaserHeadline()
    {
        $layoutkit = $this->layoutkit;
        $formkit = $layoutkit->formkit;
        $words = $layoutkit->getWords();
        $countryName = htmlspecialchars($this->countryName);
        $regionName = htmlspecialchars($this->regionName);
        return '<a href="/places/">' . $words->get('Countries'). '</a> &raquo; <a href="/places/' . $countryName. '/' . $this->countryCode . '/">'
            . $countryName . '</a> &raquo; <a href="/places/' . $countryName. '/' . $this->countryCode . '/'
            . $regionName . '/' . $this->regionCode . '/">' . $regionName . '</a>'
            . ' &raquo; ' . htmlspecialchars($this->cityName);
    }
    
    protected function getColumnNames()
    {
        // we don't need the other columns
        return array('col3');
    }

    protected function getStylesheets() {
       $stylesheets = parent::getStylesheets();
       $stylesheets[] = 'styles/css/minimal/screen/custom/places.css?2';
       return $stylesheets;
    }

    protected function leftSidebar(){

    }

}
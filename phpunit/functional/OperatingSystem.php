<?php

/**
 * ---------------------------------------------------------------------
 *
 * GLPI - Gestionnaire Libre de Parc Informatique
 *
 * http://glpi-project.org
 *
 * @copyright 2015-2024 Teclib' and contributors.
 * @copyright 2003-2014 by the INDEPNET Development Team.
 * @licence   https://www.gnu.org/licenses/gpl-3.0.html
 *
 * ---------------------------------------------------------------------
 *
 * LICENSE
 *
 * This file is part of GLPI.
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <https://www.gnu.org/licenses/>.
 *
 * ---------------------------------------------------------------------
 */

namespace tests\units;

/* Test for inc/operatingsystem.class.php */

class OperatingSystem extends CommonDropdown
{
    public function getObjectClass()
    {
        return '\OperatingSystem';
    }

    public static function typenameProvider()
    {
        return [
            [\OperatingSystem::getTypeName(), 'Operating systems'],
            [\OperatingSystem::getTypeName(0), 'Operating systems'],
            [\OperatingSystem::getTypeName(10), 'Operating systems'],
            [\OperatingSystem::getTypeName(1), 'Operating system']
        ];
    }

    protected function getTabs()
    {
        return [
            'OperatingSystem$main'  => "<span><i class='ti ti-device-desktop-cog me-2'></i>Operating system</span>",
        ];
    }

    /**
     * Create new Operating system in database
     *
     * @return \CommonDBTM
     */
    protected function newInstance(): \CommonDBTM
    {
        $instance = new \OperatingSystem();
        $this->assertGreaterThan(
            0,
            $instance->add([
                'name' => 'OS name ' . $this->getUniqueString()
            ])
        );
        $this->assertTrue($instance->getFromDB($instance->getID()));

        return $instance;
    }
}
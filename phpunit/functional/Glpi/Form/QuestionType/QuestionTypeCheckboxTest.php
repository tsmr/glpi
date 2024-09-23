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

namespace tests\units\Glpi\Form\QuestionType;

use DbTestCase;
use Glpi\Form\Destination\FormDestinationTicket;
use Glpi\Form\QuestionType\QuestionTypeCheckbox;
use Glpi\Tests\FormBuilder;
use Glpi\Tests\FormTesterTrait;

final class QuestionTypeCheckboxTest extends DbTestCase
{
    use FormTesterTrait;

    public function testCheckboxAnswerIsDisplayedInTicketDescription(): void
    {
        $builder = new FormBuilder();
        $builder->addQuestion(
            name: "Shopping list",
            type: QuestionTypeCheckbox::class,
            extra_data: json_encode([
                'options' => ['Bread', 'Milk', 'Cheese', 'Eggs', 'Butter'],
            ])
        );
        $builder->addDestination(FormDestinationTicket::class, "My ticket");
        $form = $this->createForm($builder);

        $ticket = $this->sendFormAndGetCreatedTicket($form, [
            "Shopping list" => ['Bread', 'Milk', 'Cheese'],
        ]);

        $this->assertStringContainsString(
            "1) Shopping list: Bread, Milk, Cheese",
            strip_tags($ticket->fields['content']),
        );
    }
}
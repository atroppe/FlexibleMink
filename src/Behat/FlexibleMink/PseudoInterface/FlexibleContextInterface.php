<?php

namespace Behat\FlexibleMink\PseudoInterface;

use Behat\Gherkin\Node\TableNode;
use Behat\Mink\Element\NodeElement;
use Behat\Mink\Exception\DriverException;
use Behat\Mink\Exception\ElementNotFoundException;
use Behat\Mink\Exception\ExpectationException;
use Behat\Mink\Exception\UnsupportedDriverActionException;
use Behat\Mink\Session;

/**
 * Pseudo interface for tracking the methods of the FlexibleContext.
 */
trait FlexibleContextInterface
{
    /**
     * This method overrides the MinkContext::assertPageContainsText() default behavior for assertPageContainsText to
     * ensure that it waits for the text to be available with a max time limit.
     *
     * @see MinkContext::assertPageContainsText
     * @param string $text Text to be searched in the page.
     */
    abstract public function assertPageContainsText($text);

    /**
     * Returns Mink session.
     *
     * @param  string|null $name name of the session OR active session will be used
     * @return Session
     */
    abstract public function getSession($name = null);

    /**
     * This method overrides the MinkContext::assertPageNotContainsText() default behavior for assertPageNotContainsText
     * to ensure that it waits for the item to not be available with a max time limit.
     *
     * @see MinkContext::assertPageNotContainsText
     * @param string $text The text that should not be found on the page.
     */
    abstract public function assertPageNotContainsText($text);

    /**
     * This method overrides the MinkContext::assertElementContainsText() default behavior for
     * assertElementContainsText to ensure that it waits for the item to be available with a max time limit.
     *
     * @see MinkContext::assertElementContainsText
     * @param string|array $element css element selector
     * @param string       $text    expected text
     */
    abstract public function assertElementContainsText($element, $text);

    /**
     * Clicks a visible link with specified id|title|alt|text.
     *
     * This method overrides the MinkContext::clickLink() default behavior for clickLink to ensure that only visible
     * links are clicked.
     * @see MinkContext::clickLink
     * @param string $locator The id|title|alt|text of the link to be clicked.
     */
    abstract public function clickLink($locator);

    /**
     * Finds the first matching visible link on the page.
     *
     * Warning: Will return the first link if the driver does not support visibility checks.
     *
     * @param  string               $locator The link name.
     * @throws ExpectationException If a visible link was not found.
     * @return NodeElement          The link.
     */
    abstract public function assertVisibleLink($locator);

    /**
     * Checks that the page contains a visible input field and then returns it.
     *
     * @param $fieldName
     * @throws ExpectationException If a visible input field is not found.
     * @return NodeElement          The found input field.
     */
    abstract public function assertFieldExists($fieldName);

    /**
     * Checks that the page not contain a visible input field.
     *
     * @param  string               $fieldName The name of the input field.
     * @throws ExpectationException If a visible input field is found.
     */
    abstract public function assertFieldNotExists($fieldName);

    /**
     * Checks that the page contains the given lines of text in the order specified.
     *
     * @param  TableNode            $table A list of text lines to look for.
     * @throws ExpectationException if a line is not found, or is found out of order.
     */
    abstract public function assertLinesInOrder(TableNode $table);

    /**
     * This method will check if all the fields exists and visible in the current page.
     *
     * @param  TableNode            $tableNode The id|name|title|alt|value of the input field
     * @throws ExpectationException if any of the fields is not visible in the page
     */
    abstract public function assertPageContainsFields(TableNode $tableNode);

    /**
     * This method will check if all the fields not exists or not visible in the current page.
     *
     * @param  TableNode            $tableNode The id|name|title|alt|value of the input field
     * @throws ExpectationException if any of the fields is visible in the page
     */
    abstract public function assertPageNotContainsFields(TableNode $tableNode);

    /**
     * Assert if the option exist/not exist in the select.
     *
     * @param  string                   $select    The name of the select
     * @param  string                   $existence The status of the option item
     * @param  string                   $option    The name of the option item
     * @throws ElementNotFoundException If the select is not found in the page
     * @throws ExpectationException     If the option is exist/not exist as expected
     */
    abstract public function assertSelectContainsOption($select, $existence, $option);

    /**
     * Attaches a local file to field with specified id|name|label|value. This is used when running behat and
     * browser session in different containers.
     *
     * @param string $field The file field to select the file with
     * @param string $path  The local path of the file
     */
    abstract public function addLocalFileToField($field, $path);

    /**
     * Scrolls the window to the top or bottom of the page body.
     *
     * @param  string                           $where to scroll to. Must be either "top" or "bottom".
     * @throws UnsupportedDriverActionException When operation not supported by the driver
     * @throws DriverException                  When the operation cannot be done
     */
    abstract public function scrollWindowToBody($where);
}

<?php
namespace Rayku;

/**
 * Defines Rayku User object interface
 */
interface User
{
    function getFacebookCCUsername();
    function getGtalkCCUsername();
    function getDesktopCCUsername();
}

?>
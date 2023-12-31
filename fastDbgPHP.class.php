<?php

function fdbg(mixed ...$values)
{
    FastDbgPHP::fdbg(...$values);
}

class FastDbgPHP
{
    static private bool $isDevelopementMode = false;
    static private string $projectName = "";
    static private ?float $startTime = null;
    static private array $defaltValues = ['##GET', '##POST'];
    static private array $classList = [];
    static private array $styles = [
        'box'               => 'font-family: ui-monospace, monospace;
                                color: #363636;
                                background-color: #F6F8FC;
                                border-radius: 5px;
                                border: 1px solid #DCDCDC;
                                position: relative;
                                padding: 10px 0px 15px 15px;
                                margin: 10px 4px;',
        'header'            => 'color: #363636;
                                font-size: 18px;
                                padding: 0 0 10px;',
        'titles'            => 'color: #363636;
                                border: 1px solid #DCDCDC;
                                font-size: 18px',
        'info'              => 'border-top: 1px solid #DCDCDC;
                                font-size: 14px;
                                text-align: left;
                                padding: 5px 10px;
                                word-break: break-word;',
        'description'       => 'border-top: 1px solid #DCDCDC;
                                font-size: 12px;
                                text-align: left;
                                padding: 5px 10px;
                                word-break: break-word;',
        'descriptionCredit' => 'border-top: 1px solid #DCDCDC;
                                font-size: 12px;
                                text-align: right;
                                padding: 5px 10px;
                                word-break: break-word;',
        'arrays'            => 'border: 1px solid #DCDCDC;
                                border-radius: 5px;
                                background-color: #FFF;
                                font-size: 12px;
                                text-align: left;
                                padding: 5px 10px;
                                margin: 1px;
                                word-break: break-word;'
    ];

    public function __construct()
    {
    }

    static public function setDevelopmentMode(bool $isDevelopementMode): void
    {
        static::$isDevelopementMode = $isDevelopementMode;
    }

    static public function setProjectName(string $projectName): void
    {
        static::$projectName = $projectName;
    }

    static public function setStyles(array $styles): void
    {
        static::$styles = $styles + static::$styles;
    }

    static public function setDefaltValues(array $defaltValues): void
    {
        static::$defaltValues = $defaltValues;
    }

    static public function setStartTime(float $startTime): void
    {
        static::$startTime = $startTime;
    }

    static public function setClassList(array $classList): void
    {
        static::$classList = $classList;
    }

    /**
     * Function of the Debug
     *
     * @param mixed ... $values
     * ##TRACE - Show traceback
     * ##GET, ##POST, ##SERVER, ##FILES, ##COOKIE, ##SESSION, ##REQUEST, ##ENV - Show global var
     * ##EXIT - Finish the code
     * ##TIME
     */
    static public function fdbg(mixed ...$values): void
    {
        if (static::$isDevelopementMode) {
            if (count($values) == 0) {
                self::fdbg(...static::$defaltValues);
                return;
            }

            $debug_arr = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
            $debug_arr = end($debug_arr);
            $line = $debug_arr['line'];
            $file = $debug_arr['file'];

            echo '<div style="' . static::$styles['box'] . "\">";
            echo '<div style="' . static::$styles['header'] . "\">";
            if (static::$projectName) {
                echo "<div>💼 Project: " . static::$projectName . "</div>";
            }
            echo "<div>🪲 FAST_DBG_PHP: file $file on line line $line</div>";
            echo "</div>";

            $hasexit = false;

            echo '<div style="display: grid; grid-template-columns: 20% 80%;">';
            foreach ($values as $value) {
                if (is_null($value)) {
                    $type = get_debug_type($value);
                    static::generateRow("🏷️ Variable [$type]", "null");
                } elseif (is_bool($value)) {
                    $type = get_debug_type($value);
                    static::generateRow("🏷️ Variable [$type]", $value == true ? "True" : "False");
                } elseif ($value == "##GET") {
                    static::generateDetailRow("💾 GET params", $_GET);
                } elseif ($value == "##POST") {
                    static::generateDetailRow("💾 POST params", $_POST);
                } elseif ($value == "##SERVER") {
                    static::generateDetailRow("🖥️ Server params", $_SERVER);
                } elseif ($value == "##FILES") {
                    static::generateDetailRow("📂 File params", $_FILES);
                } elseif ($value == "##TIME") {
                    if (static::$startTime != null)
                        $time = round(microtime(true) - static::$startTime, 4) . " seconds";
                    else
                        $time = 'Define variable $startTime at the beginning of the code.';
                    static::generateRow("⏱️ Time", $time);
                    continue;
                } elseif ($value == "##TRACE") {
                    static::generateTracebackRow("🚦 Traceback");
                    continue;
                } elseif ($value == "##COOKIE") {
                    static::generateDetailRow("🍪 Cookies", $_COOKIE);
                } elseif ($value == "##SESSION") {
                    if (session_status() == PHP_SESSION_ACTIVE) {
                        static::generateDetailRow("📅 Sessions", $_SESSION);
                    } else {
                        static::generateDetailRow("📅 Sessions", "<i>Session not active</i>");
                    }
                } elseif ($value == "##REQUEST") {
                    static::generateDetailRow("🔗 Requests", $_REQUEST);
                } elseif ($value == "##ENV") {
                    static::generateDetailRow("🏠 Environment", $_ENV);
                } elseif ($value == "##EXIT") {
                    $hasexit = true;
                } else {
                    $type = get_debug_type($value);
                    static::generateDetailRow("🏷️ Variable [$type]", $value);
                }
            }

            $LePampim = '<a href ="https://github.com/LePampim" >LePampim</a>';
            $Mocno = '<a href ="https://github.com/mocno" >Mocno</a>';
            $fastDbgPHP = '<a href ="https://github.com/LePampim/FastdbgPHP" >Fast Debug PHP</a>';
            static::generateRowCredit("$fastDbgPHP developed by $LePampim and $Mocno");

            echo "</div>";
            echo '</div>';

            if ($hasexit) exit;
        }
    }

    static private function generateDetailRow(string $info, mixed $description)
    {
        if (is_string($description))
            $info .= " [" . strlen($description) . "]";
        elseif (is_array($description))
            $info .= " [" . count($description) . "]";

        echo '<div style="' . static::$styles['info'] . "\">$info</div>";
        echo '<div style="' . static::$styles['description'] . '">';

        foreach (static::$classList as $value) {
            if (is_a($description, $value)) {
                if ($description) {
                    static::generateArrayTable((array) $description);
                    echo '</div>';
                    return;
                }
            }
        }

        if (is_string($description)) {
            static::generateSimpleTable($description);
        } elseif (is_array($description)) {
            if ($description) {
                static::generateArrayTable((array) $description);
            } else
                static::generateSimpleTable("<i>Empty</i>");
        } else
            static::generateSimpleTable($description);

        echo '</div>';
    }

    static private function generateRow(string $info, mixed $description)
    {
        echo '<div style="' . static::$styles['info'] . "\">$info</div>";
        echo '<div style="' . static::$styles['description'] . '">';
        static::generateSimpleTable($description);
        echo '</div>';
    }
    static private function generateTracebackRow(string $info)
    {
        echo '<div style="' . static::$styles['info'] . "\">$info</div>";
        echo '<div style="' . static::$styles['description'] . '">';
        echo '<div style="' . static::$styles['arrays'] . "\"><pre>";
        debug_print_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
        echo '</pre></div></div>';
    }
    static private function generateRowCredit(mixed $description)
    {
        echo '<div style="' . static::$styles['info'] . "\"></div>";
        echo '<div style="' . static::$styles['descriptionCredit'] . '">' . $description . '</div>';;
    }

    static private function generateSimpleTable($value)
    {
        echo '<div style="' . static::$styles['arrays'] . "\">$value</div>";
    }

    static private function generateArrayTable(array $arrays)
    {
        echo '<div style="display: grid; grid-template-columns: 20% 80%;">';
        foreach ($arrays as $key => $value) {
            echo '<div style="' . static::$styles['arrays'] . "\">$key</div>";
            if (is_string($value))
                echo '<div style="' . static::$styles['arrays'] . "\">$value</div>";
            else {
                if (is_array($value)) {
                    if ($value)
                        static::generateArrayTable((array) $value);
                    else
                        echo '<div style="' . static::$styles['arrays'] . "\"></div>";
                } elseif (is_object($value)) {
                    echo '<div style="' . static::$styles['arrays'] . "\"><i>isObject</i></div>";
                } else {
                    echo '<div style="' . static::$styles['arrays'] . "\">$value</div>";
                }
            }
        }
        echo '</div>';
    }
}

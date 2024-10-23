<?php
require __DIR__.'/../vendor/autoload.php';
use App\Greeter;
use PHPUnit\Framework\TestCase;
use SebastianBergmann\CodeCoverage\CodeCoverage;
use SebastianBergmann\CodeCoverage\Filter;
use SebastianBergmann\CodeCoverage\Driver\Selector;
use SebastianBergmann\CodeCoverage\Report\Html\Facade as HtmlReport;

$filter = new Filter;
$filter->includeFile(__DIR__.'/../src/Greeter.php');
//$driver = Driver::forLineCoverage($filter);
$coverage = new CodeCoverage((new Selector)->forLineCoverage($filter),$filter);
 
$condition_comp = true;

class TodoTest extends TestCase{
    public function testGreetsWithName(): void
    {
        global $condition_comp;
        if ($condition_comp == true) {
            global $coverage;
            $coverage->start('testGreetsWithName');
        }
        $greeter = new Greeter;

        $greeting = $greeter->greet('Alice');

        $this->assertSame('Hello, Alice!', $greeting);
        if ($condition_comp == true) {
            $coverage->stop();
        }
    }
}
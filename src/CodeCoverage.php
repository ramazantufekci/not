<?php
include_once("../vendor/autoload.php"); 
use SebastianBergmann\CodeCoverage\CodeCoverage;

class CoverageReportGenerator
{
    private $coverage;

    public function __construct(CodeCoverage $coverage)
    {
        $this->coverage = $coverage;
    }

    public function generateMarkdownReport()
    {
        $report = $this->coverage->getReport();

        // Toplam sınıf ve metot sayısı ve bunların test edilenlerinin sayısı
        $testedClassesAndTraits = $report->numberOfTestedClassesAndTraits();
        $totalClassesAndTraits = $report->numberOfClassesAndTraits();

        $testedMethods = $report->numberOfTestedMethods();
        $totalMethods = $report->numberOfMethods();

        // Satır test durumları
        $executedLines = $report->numberOfExecutedLines();
        $totalLines = $report->numberOfExecutableLines();

        // Markdown raporu oluşturuyoruz
        $markdown = "# Code Coverage Report\n\n";
        $markdown .= "## Classes and Traits\n";
        $markdown .= "- Tested: **$testedClassesAndTraits** / **$totalClassesAndTraits**\n\n";

        $markdown .= "## Methods\n";
        $markdown .= "- Tested: **$testedMethods** / **$totalMethods**\n\n";

        $markdown .= "## Lines\n";
        $markdown .= "- Executed: **$executedLines** / **$totalLines**\n\n";

        $markdown .= "## Overall Coverage\n";
        $lineCoveragePercentage = $this->calculatePercentage($executedLines, $totalLines);
        $markdown .= "- Line Coverage: **$lineCoveragePercentage%**\n";

        // Markdown çıktısını bir dosyaya yazalım
        file_put_contents('code-coverage-report.md', $markdown);

        echo "Markdown report generated successfully!\n";
    }

    private function calculatePercentage($tested, $total)
    {
        if ($total === 0) {
            return 0;
        }
        return round(($tested / $total) * 100, 2);
    }
}

// CodeCoverage nesnesini başlatıyoruz ve raporu oluşturuyoruz (örnek veri)
$coverage = new CodeCoverage();  // Bu, gerçek test verilerinizle dolu olmalı
$reportGenerator = new CoverageReportGenerator($coverage);
$reportGenerator->generateMarkdownReport();

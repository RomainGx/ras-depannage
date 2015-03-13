<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require 'tcpdf/tcpdf.php';

/**
 * Makes possible to add some extra data in a PDF file, such
 * as an image in the header.
 * @author rguidoux
 * @version $Revision: 7 $
 * @lastmodified $Date: 2014-03-29 20:09:35 +0100 (sam., 29 mars 2014) $
 * @modifiedby $Author: Romain $
 */

class Pdf extends TCPDF
{
	/** The title to display on the header of each page */
	private $headerTitle 	= '';
	/** The data, if any, to transform in a QR Code */
	private $qrCodeData 	= null;
	
	
	public function __construct()
	{
		parent::__construct(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
	}
	
	/**
	 * Set the title to display on the header of each page.
	 * @param string $headerTitle The title to display
	 */
	public function SetHeaderTitle($headerTitle)
	{
		$this->headerTitle = $headerTitle;
	}
	/**
	 * Set the data to transform in a QR code.
	 * @param string $qrCodeData The data
	 */
	public function SetQrCodeData($qrCodeData)
	{
		$this->qrCodeData = $qrCodeData;
	}
	
	/**
	 * Overwrite the Header() method of TCPDF.
	 * @see ras_app/libraries/PHPExcel/Shared/PDF/TCPDF::Header()
	 */
    public function Header()
	{

    }

    /**
     * Overwrite the Footer() method of TCPDF.
     * @see ras_app/libraries/PHPExcel/Shared/PDF/TCPDF::Footer()
     */
    public function Footer()
	{

    }
	
    /**
     * Display an HTML text field in the PDF document.
     */
	public function writeTextarea()
    {
        echo '<div style="border:1px solid black;height:90px;">';
        for ($i=0 ; $i < 8 ; $i++)
            echo '<br />';
        echo '</div>';
    }

    /**
     * Display an HTML input in the PDF document.
     * @param int $size The size of the input
     */
    public function writeInput($size = 5)
    {
        echo '<table style="border:1px solid black;padding:3px;width:' . $size . '%;"><tr><td></td></tr></table>';
    }

    /**
     * Display an HTML slider in the PDF document.
     * @param string $leftAnswer The string to display on the left
     * @param string $rightAnswer The string to display on the right
     */
    public function writeSlider($leftAnswer, $rightAnswer)
    {
        // 52.28% is 10cm
        ?>
		<table style="width:52.28%;">
		<tr>
		<td style="text-align:left;"><?php echo $leftAnswer; ?></td>
		<td style="text-align:right;"><?php echo $rightAnswer; ?></td>
		</tr>
		<tr>
		<td colspan="2" style="border-bottom:1px solid black;"></td>
		</tr>
		</table>
		<?php
    } 
}
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller
{
	public function index()
	{
		$this->load->view('mainpage');
	}

    public function saveReport()
    {
        $postdata = file_get_contents("php://input");
        $post = json_decode($postdata, true);

        if (!empty($post['dateBegin']) && !empty($post['dateEnd']) && !empty($post['timeBegin']) &&
            !empty($post['timeEnding']) && !empty($post['signatures']) && !empty($post['signatures']['client']) &&
            !empty($post['signatures']['tech']) && !empty($post['client']) && !empty($post['clientMail']) && !empty($post['report']))
        {
            $this->load->database();

            $dateBegin = DateTime::createFromFormat('d/m/Y H:i', $post['dateBegin'] . ' ' . $post['timeBegin']);
            $dateEnd = DateTime::createFromFormat('d/m/Y H:i', $post['dateEnd'] . ' ' . $post['timeEnding']);

            $sql = 'INSERT INTO depannage ' .
                '(date_begin, date_end, client_signature, tech_signature, client, client_mail, report) VALUES ' .
                '('.
                    $this->db->escape($dateBegin->format('Y-m-d H:i:s')) . ',' .
                    $this->db->escape($dateEnd->format('Y-m-d H:i:s')) . ',' .
                    $this->db->escape('data:' . $post['signatures']['client'][0] . ',' . $post['signatures']['client'][1]) . ',' .
                    $this->db->escape('data:' . $post['signatures']['tech'][0] . ',' . $post['signatures']['tech'][1]) . ',' .
                    $this->db->escape($post['client']) . ',' .
                    $this->db->escape($post['clientMail']) . ',' .
                    $this->db->escape($post['report']) .
                ')';
            $this->db->query($sql);

            if ($this->db->affected_rows() > 0)
            {
                $this->load->library('pdf');
                $this->load->library('email');
                $this->config->load('email');
                $this->email->set_newline("\r\n");

                $post['clientSignName'] = 'tmp/' . uniqid() . '-client.png';
                $post['techSignName'] = 'tmp/' . uniqid() . '-tech.png';
                $date = date('Y-m-d--h-i');
                $pdfName = 'tmp/rapport-depannage-' . preg_replace('/[^A-Za-z0-9]/', "", $post['client']) . '-' . $date . '.pdf';

                // set document information
                $this->pdf->SetCreator(PDF_CREATOR);
                $this->pdf->SetAuthor('RA Sécurité');
                $this->pdf->SetTitle('Rapport de dépannage');
                $this->pdf->SetDisplayMode(47);
                $this->pdf->SetHeaderTitle('Rapport de dépannage');

                //set margins
                $this->pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
                $this->pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
                $this->pdf->SetFont('helvetica', '', 12);

                $this->pdf->AddPage();

                $this->base64ToJpeg($post['signatures']['client'][1], $post['clientSignName']);
                $this->base64ToJpeg($post['signatures']['tech'][1], $post['techSignName']);

                $pdfHtmlContent =  $this->load->view('home/pdf_reportTemplate', $post, true);
                $this->pdf->writeHTML($pdfHtmlContent, true, false, false, false, '');

                $this->pdf->lastPage();

                //Close and output PDF document
                $this->pdf->Output($pdfName, 'F');

                //$this->email->from('romain.archimbaud@rasecurite.fr', 'RA Sécurité');
                $this->email->from('romain.guidoux@gmail.com', 'RA Sécurité');
                //$this->email->to($post['clientMail'] . ',romain.archimbaud@rasecurite.fr');
                $this->email->to($post['clientMail'] . ',romain.guidoux@gmail.com');

                $this->email->subject('[RA Sécurité] Rapport de dépannage');
                $this->email->message('Bonjour,<br/>Veuillez trouver ci-joint le rapport de dépannage établi par RA Sécurité.<br /><br />Cordialement');
                $this->email->attach($pdfName);

                if ($this->email->send())
                    echo '{"status":"success"}';
                else
                    echo '{"status":"error", "error": "Le rapport est enregistré, mais une erreur est survenue lors de l\'envoi du mail"}';

                unlink($pdfName);
                unlink($post['clientSignName']);
                unlink($post['techSignName']);
            }
            else
                echo '{"status":"error", "error": "Une erreur est survenue lors de l\'enregistrement"}';
        }
    }

    private function base64ToJpeg($base64String, $outputFile)
    {
        $ifp = fopen($outputFile, "wb");

        fwrite($ifp, base64_decode($base64String));
        fclose($ifp);

        return $outputFile;
    }

    public function getReports()
    {
        $this->load->database();

        $query = $this->db->query('SELECT * FROM depannage ORDER BY id DESC');
        $data = array();
        foreach ($query->result() as $row)
        {
            $data[] = array(
                'id' => $row->id,
                'date_begin' => (new DateTime($row->date_begin))->format('U') * 1000,
                'date_end' => (new DateTime($row->date_end))->format('U') * 1000,
                'client_signature' => $row->client_signature,
                'tech_signature' => $row->tech_signature,
                'client' => $row->client,
                'client_mail' => $row->client_mail,
                'report' => $row->report
            );
        }

        echo json_encode($data);
    }
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */
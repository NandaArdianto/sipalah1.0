<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Report;

class StatusReportMail extends Mailable
{
    use Queueable, SerializesModels;

    public $report;
    public $status;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Report $report, $status)
    {
        $this->report = $report;
        $this->status = $status;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Status Laporan Anda Telah Diupdate')
                    ->view('emails.report_status');
    }
}

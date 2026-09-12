<?php

namespace App\Notifications;

use App\Models\Report;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LaporanSelesai extends Notification
{
    public function __construct(public Report $report)
    {
    }

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Laporan ' . $this->report->kode_laporan . ' Telah Selesai')
            ->greeting('Halo ' . $notifiable->name . ',')
            ->line('Laporan dengan kode ' . $this->report->kode_laporan . ' telah selesai ditangani.')
            ->line($this->report->deskripsi)
            ->action('Lihat Detail Laporan', url('/laporan/' . $this->report->id))
            ->line('Terima kasih atas partisipasi Anda menjaga Kota Subang.');
    }
}
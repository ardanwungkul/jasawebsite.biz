<?php
$seenIcon = !!$seen ? 'check-double' : 'check';
$new_time = date('H:i', strtotime($created_at));
$hour_minute = date('H:i', strtotime($created_at));

$timeAndSeen = "<span data-time='$created_at' class='message-time'> <span class='time' style='margin-right:2px'>$hour_minute</span>" . ($isSender ? "<span class='fas fa-$seenIcon' seen'></span>" : '') . '</span>';
?>

<div class="message-card @if ($isSender) mc-sender @endif" data-id="{{ $id }}">
    {{-- Delete Message Button --}}
    @if ($isSender)
        <div class="actions">
            <i class="fas fa-trash delete-btn" data-id="{{ $id }}"></i>
        </div>
    @endif
    {{-- Card --}}
    <div class="message-card-content">
        @if (@$attachment->type != 'image' || $message)
            <div class="message">
                {!! $message == null && $attachment != null && @$attachment->type != 'file'
                    ? $attachment->title
                    : nl2br($message) !!}
                {!! $timeAndSeen !!}
                {{-- If attachment is a file --}}
                @if (@$attachment->type == 'file')
                    <a href="{{ route(config('chatify.attachments.download_route_name'), ['fileName' => $attachment->file]) }}"
                        class="file-download">
                        <span class="fas fa-file"></span> {{ $attachment->title }}</a>
                @endif
            </div>
        @endif
        @if (@$attachment->type == 'image')
            <div class="image-wrapper" style="text-align: {{ $isSender ? 'end' : 'start' }}">
                <div class="image-file chat-image"
                    style="background-image: url('{{ Chatify::getAttachmentUrl($attachment->file) }}')">
                    <div>{{ $attachment->title }}</div>
                </div>
                <div style="margin-bottom:5px">
                    {!! $timeAndSeen !!}
                </div>
            </div>
        @endif
    </div>
</div>

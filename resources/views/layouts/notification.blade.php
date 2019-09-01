@php
/**
 * Created by PhpStorm.
 * User: dura
 * Date: 3/3/19
 * Time: 1:07 PM
 */
 /** @var array $message */

$dir = $currentLanguage->locale == 'en' ? 'right' : 'left';

@endphp
<!--Custom JavaScript -->
<script src="/plugins/toast-master/js/jquery.toast.js"></script>

@if(Session::has('message') || isset($message) && is_array($message))
    <?php $message = Session::get('message') ?: isset($message)?>
    <script>
        $(function() {
            "use strict";

                $.toast({
                    heading: '{{trans('common.'.$message['type'])}}',
                    text: '{{trans($message['text'])}}',
                    position: 'top-{{$dir}}',
                    loaderBg:'#ff6849',
                    icon: '{{$message['type']}}',
                    hideAfter: 3000,
                    stack: 6
                });
        });

    </script>
@endif


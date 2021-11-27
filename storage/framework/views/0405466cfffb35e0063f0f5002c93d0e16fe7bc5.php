<?php $__env->startSection('title',$dialog->title); ?>
<?php $__env->startSection('style'); ?>
    <style>
        .reply {
            user-select: none;
            -webkit-user-select: none;
            -khtml-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            cursor: pointer;
            display: inline-block;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <script src="https://cdn.tiny.cloud/1/oot0e9yis3fy18ar4djmbwf5jn3z0qmuys2hhcp4dz16at40/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#messageInputArea',
            plugins: 'link',
            language: 'ru',
            toolbar: 'undo redo | bold italic underline strikethrough | forecolor | link ',
            menubar: '',
            style_formats: [
                    { title: 'Параграф', block: 'p' },
                    { title: 'Ответ', block: 'blockquote', wrapper: true }
            ],
            end_container_on_empty_block: true,
            content_css: false,
            content_style: `
                p {
                    margin: 10px 0;
                }

                blockquote {
                    margin: 10px 0;
                    padding: 0px 6px 2px;
                    border: 1px solid;
                    border-color: #b5b258;
                    border-radius: 6px;
                    background-color: #f5edc2;
                    font-size: 13px;
                }

                blockquote p {
                    margin: 5px 0;
                }

                blockquote span.original-message {
                    font-size: 10px;
                    text-align: right;
                    display: block;
                }

                a {
                    text-decoration: none;
                    color: #275f92;
                }
            `
        });
    </script>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/"><?php echo e(__('app.home')); ?></a></li>
                            <li class="breadcrumb-item"><a href="/cases"><?php echo e(__('app.business_cases')); ?></a></li>
                            <li class="breadcrumb-item"><a href="/cases/<?php echo e($businessCase->slug); ?>"><?php echo e($businessCase->title); ?></a></li>
                            <li class="breadcrumb-item active"><?php echo e($dialog->title); ?></li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fliud">
                <div class="row">
                    <div class="col-md-12 mx-auto">
                        <?php echo $__env->make('layouts.includes.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <div class="card">
                            <div class="messages">
                                <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="message <?php if(\Auth::user()->id == $message->user_id): ?> owner <?php endif; ?>" id="chat-message-<?php echo e($message->id); ?>">
                                        <div class="message-info">
                                            <div class="sender"><?php echo e(\App\User::find($message->user_id)->fullname); ?></div>
                                            <label title="<?php echo e(date_format($message->created_at,"d.m.Y H:i:s")); ?>" class="date"><?php echo e(\Jenssegers\Date\Date::parse($message->created_at)->format('j F Y в H:i')); ?><span class="edit-mark" <?php if($message->edited == '0'): ?>style="display:none"<?php endif; ?>>&nbsp;(ред.)</span></label>
                                        </div>
                                        <div class="messageBody"><?php if ($message->isArchived) echo '<p>[Сообщение удалено]</p>'; else echo htmlspecialchars_decode($message->body); ?></div>
                                        <div class="reply" <?php if($message->isArchived == '1'): ?>style="display: none"<?php endif; ?> onclick="reply(this)">Ответить</div>
                                        <?php if(\Auth::user()->id == $message->user_id): ?>
                                        <div class="message-tooltip">…<span class="message-tooltip-text">
                                                <span class="tooltip-edit" onclick="editMessage(<?php echo e($message->id); ?>)" <?php if($message->isArchived): ?>style="display: none"<?php endif; ?>>Редакитровать</span>
                                                <span class="tooltip-delete" onclick="deleteAndRestoreMessage(<?php echo e($message->id); ?>, 0)" <?php if($message->isArchived): ?>style="display: none"<?php endif; ?>>Удалить</span>
                                                <span class="tooltip-restore" onclick="deleteAndRestoreMessage(<?php echo e($message->id); ?>, 1)" <?php if(!$message->isArchived): ?>style="display: none"<?php endif; ?>>Восстановить</span>
                                            </span>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <form class="sendForm" method="POST" action="/cases/<?php echo e($businessCase->slug); ?>/<?php echo e($dialog->id); ?>/send-message">
                                <?php echo csrf_field(); ?>
                                <div class="editBar" style="display: none" id="editBar">
                                    <span class="edit-caption">Редактирование сообщения: </span>
                                    <span class="edit-message-info" id="edit-message-info"></span>
                                    <div id="cancel-edit" class="cancel-edit" onclick="cancelEdit()"><i class="fa fa-close"></i></div>
                                </div>
                                <textarea name="body" id="messageInputArea" cols="30" rows="10"></textarea>
                                <input type="hidden" name="editMessage" id="editMessage">
                                <input type="submit" class="btn btn-primary col-md-12" id='messageSubmit' value="<?php echo e(__('app.send')); ?>">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script>
        var messageCont = document.getElementsByClassName("messages")[0];
        var messagesLoading = false;
        var messagesLeftUp = true;
        $(document).ready(function() {
            messageCont.scrollTop = messageCont.scrollHeight;
        });
        $(messageCont).scroll(function() {
            console.log('Scroll Triggered');
            if ($(messageCont).scrollTop() <= 100 && !messagesLoading) {
                console.log('No Messages Loading');
                messagesLoading = true;
                let topMessageID = $(messageCont).children().first().attr('id');
                console.log(topMessageID);

                if ( parseInt(topMessageID.slice(13)) == NaN | parseInt(topMessageID.slice(13)) < 0)
                    location.reload();
                else
                    topMessageID = topMessageID.slice(13);

                $.ajax({
                    type: "POST",
                    url: "/cases/<?php echo e($businessCase->slug); ?>/<?php echo e($dialog->id); ?>/loadup",
                    dataType: 'html',
                    data: {
                        '_token' : token,
                        'id' : topMessageID,
                    },
                    cache: false,
                    success: function (response)
                    {
                        messagesLoading = false;
                        var resp = JSON.parse(response);
                        console.log(resp);
                        if ('status' in resp) {
                            console.log('bp');
                            if (resp['status'] == 'success') {
                                console.log('Success');
                                for (let i = 0; i < resp['messages'].length; i++) {
                                    let messageChild = $.parseHTML(resp['messages'][i]);
                                    $(messageChild).css({'position':'absolute', 'visibility':'hidden'});
                                    $('.messages').prepend(messageChild);
                                    console.log('Added');
                                    messageCont.scrollTop = messageCont.scrollTop + $(messageChild).outerHeight();
                                    $(messageChild).css({'position':'relative', 'visibility':'visible'});
                                }
                            }
                            else if (resp['status'] == 'no-new') {
                                console.log('Scroll unbound');
                                $(messageCont).unbind('scroll');
                            }
                            else if (resp['status'] == '403') swal({
                                title: "Ошибка!",
                                text: "Доступ запрещён!",
                                icon: "error",
                            });
                        } else {
                            console.log(response);
                            swal({
                                title: "Упс!",
                                text: "Произошла ошибка! Пожалуйста, свяжитесь с администратором, если перезагрузка страницы не помогает.",
                                icon: "error",
                            });
                        }
                    },
                    error: function (response) {
                        messagesLoading = false;
                        console.log(response);
                        swal({
                            title: "Упс!",
                            text: "Произошла ошибка! Пожалуйста, свяжитесь с администратором, если перезагрузка страницы не помогает.",
                            icon: "error",
                        });
                    },
                });
            }
        });
        function isOrContains(node, container) {
            while (node) {
                if (node === container) {
                    return true;
                }
                node = node.parentNode;
            }
            return false;
        }

        function elementContainsSelection(el) {
            var sel;
            if (window.getSelection) {
                console.log('window.getSelection = true');
                sel = window.getSelection();
                console.log(sel);
                if (sel.rangeCount > 0) {
                    console.log('rangeCount > 0');
                    console.log(sel.rangeCount);
                    for (var i = 0; i < sel.rangeCount; ++i) {
                        console.log('rangecount ' + i);
                        console.log(sel.getRangeAt(i).commonAncestorContainer);
                        console.log(el);
                        if (!isOrContains(sel.getRangeAt(i).commonAncestorContainer, el)) {
                            console.log('iteration returns false');
                            return false;
                        }
                    }
                    return true;
                }
            } else if ( (sel = document.selection) && sel.type != "Control") {
                console.log('else if');
                return isOrContains(sel.createRange().parentElement(), el);
            }
            console.log('simply false');
            return false;
        }
        function getSelectionHtml() {
            var html = "";
            if (typeof window.getSelection != "undefined") {
                var sel = window.getSelection();
                if (sel.rangeCount) {
                    var container = document.createElement("div");
                    for (var i = 0, len = sel.rangeCount; i < len; ++i) {
                        container.appendChild(sel.getRangeAt(i).cloneContents());
                    }
                    html = container.innerHTML;
                }
            } else if (typeof document.selection != "undefined") {
                if (document.selection.type == "Text") {
                    html = document.selection.createRange().htmlText;
                }
            }
            return html;
        }
        function reply(element) {
            let messageBody = element.previousElementSibling;
            let messageAuthor = element.previousElementSibling.previousElementSibling.children[0].innerText;
            let messageTime = element.previousElementSibling.previousElementSibling.children[1].innerText;
            if (elementContainsSelection(messageBody)) {
                let resultText = getSelectionHtml();
                if (resultText.substring(0,2) != '<p') {
                    resultText = '<p>' + resultText + '</p>';
                }
                tinymce.get('messageInputArea').insertContent('<blockquote>' +
                    resultText +
                    '<span class="original-message">' +
                    messageAuthor +
                    ' - '
                    + messageTime +
                    '</span></blockquote><p></p>');
                return;
            }
            tinymce.get('messageInputArea').insertContent('<blockquote>' +
                messageBody.innerHTML +
                '<span class="original-message">' +
                messageAuthor +
                ' - '
                + messageTime +
                '</span></blockquote><p></p>');
        }
        function editMessage(messageID) {
            $('#editMessage').val(messageID);
            $('#editBar').show();
            let messageAuthor = document.getElementById('chat-message-' + messageID).children[0].children[0].innerText;
            let messageTime = document.getElementById('chat-message-' + messageID).children[0].children[1].innerText;
            let messageBody = document.getElementById('chat-message-' + messageID).children[1].innerHTML;
            tinymce.get('messageInputArea').setContent(messageBody);
            document.getElementById('edit-message-info').innerText = messageAuthor + ' - ' + messageTime;
            document.getElementById('messageSubmit').value = '<?php echo e(__('app.edit')); ?>';
        }
        function cancelEdit() {
            $('#editMessage').val('');
            $('#editBar').hide();
            document.getElementById('edit-message-info').innerText = '';
            tinymce.get('messageInputArea').setContent('<p></p>');
            document.getElementById('messageSubmit').value = '<?php echo e(__('app.send')); ?>';
        }

        var last_updated = "<?php echo e($refresh_time); ?>";
        var token = $('meta[name="csrf-token"]').attr('content');

        function sendMessage(event) {
            var form = $(this);
            $.ajax({
                type: "POST",
                url: "/cases/<?php echo e($businessCase->slug); ?>/<?php echo e($dialog->id); ?>/send-message",
                dataType: 'html',
                data: {
                    '_token' : token,
                    'last_updated' : last_updated,
                    'body' : tinymce.get('messageInputArea').getContent(),
                    'editMessage' : form.find('[name=editMessage]').val()
                },
                cache: false,
                success: function (response)
                {
                    var resp = JSON.parse(response);
                    if ('status' in resp) {
                        if (resp['status'] == '200') {
                            refresh();
                            tinymce.get('messageInputArea').setContent('<p></p>');
                            $('#cancel-edit').click();
                        }
                        else if (resp['status'] == '403') swal({
                            title: "Ошибка!",
                            text: "Доступ запрещён!",
                            icon: "error",
                        });
                        else if (resp['status'] == '404') swal({
                            title: "Ошибка!",
                            text: "Сообщение не найдено!",
                            icon: "error",
                        });
                        else if (resp['status'] == 'empty-message') swal({
                            title: "Ошибка!",
                            text: "Сообщение не может быть пустым!",
                            icon: "error",
                        });
                    } else {
                        console.log(response);
                        swal({
                            title: "Упс!",
                            text: "Произошла ошибка! Пожалуйста, свяжитесь с администратором, если перезагрузка страницы не помогает.",
                            icon: "error",
                        });
                    }
                },
                error: function (response) {
                    console.log(response);
                    swal({
                        title: "Упс!",
                        text: "Произошла ошибка! Пожалуйста, свяжитесь с администратором, если перезагрузка страницы не помогает.",
                        icon: "error",
                    });
                },
            });
            event.preventDefault();
        }
        document.getElementsByClassName('sendForm')[0].addEventListener("submit", sendMessage);

        function deleteAndRestoreMessage(messageID, dr) {
            $.ajax({
                type: "POST",
                url: "/cases/<?php echo e($businessCase->slug); ?>/<?php echo e($dialog->id); ?>/delete-and-restore-message",
                dataType: 'html',
                data: {
                    '_token' : token,
                    'id' : messageID,
                    'dr' : dr
                },
                cache: false,
                success: function (response)
                {
                    var resp = JSON.parse(response);
                    if ('status' in resp) {
                        if (resp['status'] == '200') refresh();
                        if (resp['status'] == '403') swal({
                            title: "Ошибка!",
                            text: "Доступ запрещён!",
                            icon: "error",
                        });
                        if (resp['status'] == '404') swal({
                            title: "Ошибка!",
                            text: "Сообщение не найдено!",
                            icon: "error",
                        });
                    } else {
                        console.log(response);
                        swal({
                            title: "Упс!",
                            text: "Произошла ошибка! Пожалуйста, свяжитесь с администратором, если перезагрузка страницы не помогает.",
                            icon: "error",
                        });
                    }
                },
                error: function (response) {
                    console.log(response);
                    swal({
                        title: "Упс!",
                        text: "Произошла ошибка! Пожалуйста, свяжитесь с администратором, если перезагрузка страницы не помогает.",
                        icon: "error",
                    });
                },
            });
        }

        function refresh() {
            $.ajax({
                type: "POST",
                url: "/cases/<?php echo e($businessCase->slug); ?>/<?php echo e($dialog->id); ?>/refresh",
                dataType: 'html',
                data: {'_token' : token, 'last_updated' : last_updated},
                cache: false,
                success: function (response)
                {
                    var resp = JSON.parse(response);
                    if ('status' in resp) {
                        if (resp['status'] == 'success') analyseResponse(resp);
                    } else {
                        console.log(response);
                    }
                },
                error: function (response) {
                    console.log(response);
                },
            });
        }
        function analyseResponse(response) {
            for (let i = 0; i < response['messages'].length; i++) {
                if (response['messages'][i]['pushMessage'])
                    pushMessage(response['messages'][i]);

                else if (response['messages'][i]['deleteMessage'])
                    removeMessage(response['messages'][i]['id']);

                else if (response['messages'][i]['updateMessage'])
                    updateMessage(response['messages'][i]);
            }
            last_updated = response['last_updated'];
        }
        function pushMessage(message) {
            let element = document.getElementsByClassName("messages")[0];
            let scrollDown = false;
            if (element.scrollTop == element.scrollHeight) scrollDown = true;

            let messageHTML = '<div class="message';

            // Push message to right side
            if (message['isOwner']) messageHTML += ' owner';

            // Message info
            messageHTML += '" id="chat-message-' + message['id'] + '">' +
                '<div class="message-info">' +
                '<div class="sender">' + message['author'] + '</div>' +
                '<label title="' + message['time_precise'] + '" class="date">' +
                message['time_locale'] + '<span class="edit-mark" ';

            //  Edit mark display
            if (!message['updateMessage'])
                messageHTML += 'style="display:none"';

            messageHTML += '>&nbsp;(ред.)</span></label></div><div class="messageBody">';

            // Message content
            if (message['deleteMessage'])
                messageHTML += '<p>[Сообщение удалено]</p>';
            else
                messageHTML += message['body'];

            messageHTML += '</div>';

            // Reply button
            messageHTML += '<div class="reply" onclick="reply(this)"';
            if (message['deleteMessage']) messageHTML += ' style="display:none"';
            messageHTML +='>Ответить</div>';

            // Tooltip text
            messageHTML += '<div class="message-tooltip">…<span class="message-tooltip-text">';

            // Tooltip content
            if (message['owner']) {
                messageHTML += '<span onclick="editMessage(' + message['id'] + ')"';
                if (message['deleteMessage']) messageHTML += ' style="display: none"';
                messageHTML += '>Редакитровать</span><span onclick="deleteAndRestoreMessage(' + message['id'] + ', 0)"';
                if (message['deleteMessage']) messageHTML += ' style="display: none"';
                messageHTML += '>Удалить</span><span onclick="deleteAndRestoreMessage(' + message['id'] + ', 1)"';
                if (!message['deleteMessage']) messageHTML += ' style="display: none"';
                messageHTML += '>Восстановить</span></span></div></div>';
            }

            let messageChild = $.parseHTML(messageHTML);
            $('.messages').append(messageChild);
            element.scrollTop = element.scrollHeight;
        }
        function updateMessage(message) {
            let renderedMessages = document.getElementsByClassName('message');
            for (let i = 0; i < renderedMessages.length; i++) {
                if ( parseInt(renderedMessages[i].id.slice(13)) == NaN | parseInt(renderedMessages[i].id.slice(13)) < 0)
                    location.reload();
                else if (parseInt(renderedMessages[i].id.slice(13)) == message['id'])  {
                    $('#chat-message-' + message['id'] + ' .messageBody').html(message['body']);
                    $('#chat-message-' + message['id'] + ' .edit-mark').show();
                    $('#chat-message-' + message['id'] + ' .tooltip-edit').show();
                    $('#chat-message-' + message['id'] + ' .tooltip-delete').show();
                    $('#chat-message-' + message['id'] + ' .tooltip-restore').hide();
                    return;
                }
            }
        }
        function removeMessage(messageID) {
            let renderedMessages = document.getElementsByClassName('message');
            for (let i = 0; i < renderedMessages.length; i++) {
                if ( parseInt(renderedMessages[i].id.slice(13)) == NaN | parseInt(renderedMessages[i].id.slice(13)) < 0)
                    location.reload();
                else if (parseInt(renderedMessages[i].id.slice(13)) == messageID)  {
                    $('#chat-message-' + messageID + ' .messageBody').html('<p>[Сообщение удалено]</p>');
                    $('#chat-message-' + messageID + ' .tooltip-edit').hide();
                    $('#chat-message-' + messageID + ' .tooltip-delete').hide();
                    $('#chat-message-' + messageID + ' .tooltip-restore').show();
                    return;
                }
            }
        }
        setInterval(refresh, 5000);
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Soft\OpenServer\domains\MirVseh\resources\views/dialog/show.blade.php ENDPATH**/ ?>
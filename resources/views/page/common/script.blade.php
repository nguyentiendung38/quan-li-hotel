<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Chatbot Gemini</title>
    <script src="{{ asset('page/js/jquery.min.js') }}"></script>
    <style>
        /* CSS cho icon Zalo */
        .zalo-chat-icon {
            position: fixed;
            top: 350px;
            right: 10px;
            z-index: 1000;
            padding: 10px;
            border-radius: 50%;
            cursor: pointer;
            animation: shake 1s ease-in-out 3;
        }

        .zalo-chat-icon img {
            width: 50px;
            height: 50px;
        }

        /* CSS cho icon Facebook */
        .fb-chat-icon {
            position: fixed;
            top: 410px;
            right: 10px;
            z-index: 1001;
            padding: 10px;
            border-radius: 50%;
            cursor: pointer;
            animation: shake 1s ease-in-out 3;
        }

        .fb-chat-icon img {
            width: 50px;
            height: 50px;
        }

        #gemini-chatbot-container {
            position: fixed;
            bottom: 80px;
            right: 20px;
            width: 400px; /* Increased from 300px to 400px */
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: none;
            flex-direction: column;
        }

        #gemini-chatbot-header {
            padding: 15px;
            background: #007bff;
            color: white;
            border-radius: 10px 10px 0 0;
            cursor: pointer;
        }

        #gemini-chatbot-body {
            height: 350px; /* Reduced from 400px */
            display: flex;
            flex-direction: column;
            position: relative;
        }

        #gemini-chatbot-messages {
            flex-grow: 1;
            overflow-y: auto;
            padding: 15px;
            padding-bottom: 100px; /* Make space for input area */
        }

        .input-container {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: white;
            padding: 15px;
            border-top: 1px solid #ddd;
            border-radius: 0 0 10px 10px;
        }

        #gemini-chatbot-input {
            width: calc(100% - 16px); /* Account for padding */
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        #gemini-chatbot-send {
            width: 100%;
            padding: 8px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .chat-message {
            display: flex;
            align-items: start;
            margin-bottom: 15px;
            padding: 8px;
        }

        .message-content {
            flex: 1;
            padding: 8px 12px;
            border-radius: 15px;
            max-width: 80%;
        }

        .user-message {
            flex-direction: row-reverse;
        }

        .user-message .message-content {
            background: #e9ecef;
            margin-left: auto;
        }

        .bot-message .message-content {
            background: #f8f9fa;
        }

        .avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            margin-right: 8px;
            flex-shrink: 0;
            display: inline-block;
            vertical-align: middle;
        }

        .avatar_primary {
            background: #007bff;
            color: white;
            text-align: center;
            line-height: 32px;
            font-weight: bold;
        }

        .error {
            color: red;
        }

        /* Add new CSS for chat icon */
        .chat-icon-toggle {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1003;
            cursor: pointer;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: #007bff;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }

        .chat-icon-toggle:hover {
            transform: scale(1.1);
            background: #0056b3;
        }

        .chat-icon-toggle img {
            width: 30px;
            height: 30px;
        }
    </style>
</head>
<body>

    <div class="zalo-chat-icon" onclick="openZaloChat()">
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/91/Icon_of_Zalo.svg/1024px-Icon_of-Zalo.svg.png" alt="Chat Zalo">
    </div>

    <div class="fb-chat-icon" onclick="openFbChat()">
        <img src="https://upload.wikimedia.org/wikipedia/commons/5/51/Facebook_f_logo_%282019%29.svg" alt="Chat Facebook">
    </div>

    <script src="https://sp.zalo.me/plugins/sdk.js"></script>

    <script>
        function openZaloChat() {
            window.open("https://zalo.me/0773398244", "_blank");
        }

        function openFbChat() {
            window.open("https://www.facebook.com/congtydulichtourshue/", "_blank");
        }
    </script>

    <div id="gemini-chatbot-container">
        <div id="gemini-chatbot-header">
            Gemini Chatbot
        </div>
        <div id="gemini-chatbot-body">
            <div id="gemini-chatbot-messages"></div>
            <div class="input-container">
                <input type="text" id="gemini-chatbot-input" placeholder="Type your message...">
                <button id="gemini-chatbot-send">Send</button>
            </div>
        </div>
    </div>

    <div id="gemini-chatbot-toggle" class="chat-icon-toggle">
        <img src="https://cdn-icons-png.flaticon.com/512/4712/4712109.png" alt="Chat Icon">
    </div>

    <script>
        $(document).ready(function() {
            $("#gemini-chatbot-toggle").click(function() {
                $("#gemini-chatbot-container").toggle();
                $("#gemini-chatbot-body").show();
            });

            $("#gemini-chatbot-input").keypress(function(e) {
                if (e.which == 13) {
                    $("#gemini-chatbot-send").click();
                }
            });

            $("#gemini-chatbot-send").click(function() {
                var message = $("#gemini-chatbot-input").val().trim();
                if (!message) return;

                // Add user message with avatar
                $("#gemini-chatbot-messages").append(`
                    <div class="chat-message user-message">
                        <div class="message-content">
                            <strong>You:</strong> ${message}
                        </div>
                        <div class="avatar avatar_primary">U</div>
                    </div>
                `);

                $("#gemini-chatbot-input").val('').prop('disabled', true);
                $("#gemini-chatbot-send").prop('disabled', true);

                // Show loading indicator with avatar
                $("#gemini-chatbot-messages").append(`
                    <div class="chat-message bot-message" id="loading-message">
                        <div class="avatar avatar_primary">G</div>
                        <div class="message-content">
                            Gemini is thinking...
                        </div>
                    </div>
                `);

                $.ajax({
                    url: "{{ route('gemini.chat') }}",
                    method: "POST",
                    data: {
                        message: message,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        $("#loading-message").remove();
                        if (response.success) {
                            $("#gemini-chatbot-messages").append(`
                                <div class="chat-message bot-message">
                                    <div class="avatar avatar_primary">G</div>
                                    <div class="message-content">
                                        <strong>Gemin:</strong> ${response.response}
                                    </div>
                                </div>
                            `);
                        } else {
                            $("#gemini-chatbot-messages").append(`
                                <div class="chat-message bot-message error">
                                    <div class="avatar avatar_primary">G</div>
                                    <div class="message-content">
                                        Error: ${response.error || 'Could not get response from Gemini'}
                                    </div>
                                </div>
                            `);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Chat error:', {xhr: xhr, status: status, error: error});
                        $("#loading-message").remove();
                        $("#gemini-chatbot-messages").append(`
                            <div class="chat-message bot-message error">
                                <div class="avatar avatar_primary">G</div>
                                <div class="message-content">
                                    Error: ${error}
                                </div>
                            </div>
                        `);
                    },
                    complete: function() {
                        $("#gemini-chatbot-input").prop('disabled', false);
                        $("#gemini-chatbot-send").prop('disabled', false);
                        $("#gemini-chatbot-body").scrollTop($("#gemini-chatbot-body")[0].scrollHeight);
                    }
                });
            });
        });
    </script>
</body>
</html>
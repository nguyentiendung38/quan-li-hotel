<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Chatbot Gemini</title>
    <script src="{{ asset('page/js/jquery.min.js') }}"></script>
    <style>
        /* Chat icons container */
        .chat-icons-container {
            position: fixed;
            right: 20px;
            bottom: 20px;
            display: flex;
            flex-direction: column;
            gap: 15px;
            z-index: 1000;
        }

        /* Common styles for all chat icons */
        .chat-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease;
        }

        .chat-icon:hover {
            transform: scale(1.1);
        }

        .chat-icon img {
            width: 30px;
            height: 30px;
            object-fit: contain;
        }

        .zalo-chat-icon {
            background: #0068ff;
        }

        .fb-chat-icon {
            background: #0084ff;
        }

        .gemini-chat-icon {
            background: #007bff;
        }

        /* Modern chatbot container styling */
        #gemini-chatbot-container {
            position: fixed;
            bottom: 20px; /* Adjusted to align with chat icons, considering their size and spacing */
            right: 70px;
            width: 380px;
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 5px 30px rgba(0, 0, 0, 0.15);
            display: none;
            flex-direction: column;
            border: 1px solid rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: all 0.3s ease;
            margin-bottom: 0; /* Remove any bottom margin */
        }

        #gemini-chatbot-header {
            padding: 20px;
            background: linear-gradient(135deg, #0062cc, #007bff);
            color: white;
            font-weight: 600;
            font-size: 16px;
            display: flex;
            align-items: center;
            gap: 10px;
            position: relative;
        }

        #gemini-chatbot-header:before {
            content: '';
            width: 12px;
            height: 12px;
            background: #4CAF50;
            border-radius: 50%;
            display: inline-block;
            margin-right: 8px;
        }

        /* Close button styling */
        .header-controls {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .close-chat {
            color: white;
            background: rgba(255, 255, 255, 0.2);
            border: none;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .close-chat:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: scale(1.1);
        }

        #gemini-chatbot-body {
            height: 410px; /* Điều chỉnh chiều cao form chat ở đây */
            display: flex;
            flex-direction: column;
            background: #f8f9fa;
            position: relative;
        }

        #gemini-chatbot-messages {
            flex: 1;
            overflow-y: auto;
            padding: 20px 20px 0 20px; /* Changed to remove bottom padding */
            background: #fff;
            margin-bottom: 0; /* Changed from 80px to 0 */
            border-bottom: none; /* Add this line to remove border */
        }

        .input-container {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 15px;
            background: #fff;
            border-top: 1px solid #eee;
            display: flex;
            align-items: center;
            position: relative;
        }

        #gemini-chatbot-input {
            width: 100%;
            padding: 12px 15px;
            padding-right: 100px; /* Space for the button */
            border: 2px solid #e0e0e0;
            border-radius: 25px;
            font-size: 14px;
            background: #f8f9fa;
        }

        #gemini-chatbot-input:focus {
            outline: none;
            border-color: #007bff;
            background: #fff;
            box-shadow: 0 0 0 4px rgba(0,123,255,0.1);
        }

        #gemini-chatbot-send {
            position: absolute;
            right: 25px;
            padding: 8px;
            background: transparent;
            color: #007bff;
            border: none;
            border-radius: 50%;
            cursor: pointer;
            width: 40px;
            height: 40px;
            display: none; /* Hide by default */
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        #gemini-chatbot-send i {
            font-size: 20px;
        }

        #gemini-chatbot-send:hover {
            background: rgba(0,123,255,0.1);
            transform: translateY(-1px);
        }

        /* Message bubbles styling */
        .chat-message {
            margin-bottom: 20px;
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .message-content {
            padding: 12px 18px;
            border-radius: 18px;
            max-width: 85%;
            font-size: 14px;
            line-height: 1.5;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }

        .user-message .message-content {
            background: linear-gradient(135deg, #007bff, #0056b3);
            color: white;
            border-bottom-right-radius: 5px;
            margin-left: auto;
        }

        .bot-message .message-content {
            background: white;
            border: 1px solid #e0e0e0;
            border-bottom-left-radius: 5px;
        }

        .error {
            color: red;
        }

        .gemini-icon {
            width: 24px;
            height: 24px;
            background: #007bff;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-right: 8px;
            vertical-align: middle;
        }

        .gemini-icon img {
            width: 16px;
            height: 16px;
        }

        .customer-icon {
            width: 24px;
            height: 24px;
            background: #28a745;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-right: 8px;
            vertical-align: middle;
        }

        .customer-icon img {
            width: 16px;
            height: 16px;
        }
    </style>
</head>
<body>

    <!-- New structure for chat icons -->
    <div class="chat-icons-container">
        <div class="chat-icon zalo-chat-icon" onclick="openZaloChat()">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/91/Icon_of_Zalo.svg/1024px-Icon_of-Zalo.svg.png" alt="Chat Zalo">
        </div>

        <div class="chat-icon fb-chat-icon" onclick="openFbChat()">
            <img src="https://upload.wikimedia.org/wikipedia/commons/5/51/Facebook_f_logo_%282019%29.svg" alt="Chat Facebook">
        </div>

        <div id="gemini-chatbot-toggle" class="chat-icon gemini-chat-icon">
            <img src="https://cdn-icons-png.flaticon.com/512/4712/4712109.png" alt="Chat Gemini">
        </div>
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
            <img src="https://cdn-icons-png.flaticon.com/512/4712/4712109.png" alt="Bot Avatar" style="width: 24px; height: 24px;">
            Fun Travel Assistant
            <div class="header-controls">
                <button class="close-chat">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <div id="gemini-chatbot-body">
            <div id="gemini-chatbot-messages"></div>
            <div class="input-container">
                <input type="text" id="gemini-chatbot-input" placeholder="Hỏi Gemini">
                <button id="gemini-chatbot-send">
                    <i class="fas fa-paper-plane"></i>
                </button>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $("#gemini-chatbot-toggle").click(function() {
                $("#gemini-chatbot-container").toggle();
                $("#gemini-chatbot-body").show();
            });

            $(".close-chat").click(function() {
                $("#gemini-chatbot-container").hide();
            });

            $("#gemini-chatbot-input").on('input', function() {
                if ($(this).val().trim().length > 0) {
                    $("#gemini-chatbot-send").css('display', 'flex');
                } else {
                    $("#gemini-chatbot-send").hide();
                }
            });

            $("#gemini-chatbot-input").keypress(function(e) {
                if (e.which == 13) {
                    $("#gemini-chatbot-send").click();
                }
            });

            $("#gemini-chatbot-send").click(function() {
                var message = $("#gemini-chatbot-input").val().trim();
                if (!message) return;

                // Update user message with customer icon
                $("#gemini-chatbot-messages").append(`
                    <div class="chat-message user-message">
                        <div class="message-content">
                            <div class="customer-icon">
                                <img src="https://cdn-icons-png.flaticon.com/512/1077/1077063.png" alt="User">
                            </div>
                            ${message}
                        </div>
                    </div>
                `);

                $("#gemini-chatbot-input").val('').prop('disabled', true);
                $("#gemini-chatbot-send").prop('disabled', true);

                // Update loading message without avatar
                $("#gemini-chatbot-messages").append(`
                    <div class="chat-message bot-message" id="loading-message">
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
                                    <div class="message-content">
                                        <div class="gemini-icon">
                                            <img src="https://cdn-icons-png.flaticon.com/512/4712/4712109.png" alt="Gemini">
                                        </div>
                                        ${response.response}
                                    </div>
                                </div>
                            `);
                        } else {
                            $("#gemini-chatbot-messages").append(`
                                <div class="chat-message bot-message error">
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
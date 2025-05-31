<style>
    /* Your existing chat container styles */
  .chat-container {
    position: fixed;
    bottom: 20px;
    right: 20px;
    width: 380px;
    z-index: 9999; /* Increased from 1000 */
    font-family: 'Segoe UI', Roboto, sans-serif;
  } 

  /* Toggle Button */
  .chat-toggle-btn {
    background: linear-gradient(135deg, #4361ee, #3a0ca3);
    color: white;
    border: none;
    border-radius: 30px;
    padding: 12px 20px;
    font-size: 16px;
    font-weight: 500;
    cursor: pointer;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    display: flex;
    justify-content: space-between;
    align-items: center;
    width: 100%;
    transition: all 0.3s ease;
  }

  .chat-toggle-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(0, 0, 0, 0.2);
  }

  /* Chat Window */
  .chat-window {
    background: white;
    border-radius: 16px;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
    overflow: hidden;
    margin-top: 12px;
    height: 0;
    opacity: 0;
    transition: all 0.3s ease;
  }

  .chat-window.show {
    height: 500px;
    opacity: 1;
  }

  /* Chat Header */
  .chat-header {
    background: linear-gradient(135deg, #4361ee, #3a0ca3);
    color: white;
    padding: 16px;
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  .chat-title {
    font-weight: 600;
    font-size: 18px;
  }

  .close-btn {
    background: none;
    border: none;
    color: white;
    font-size: 20px;
    cursor: pointer;
    padding: 0;
    line-height: 1;
  }

  /* Messages Area */
  .messages-container {
    height: 370px;
    padding: 16px;
    overflow-y: auto;
    background: #f8f9fa;
  }

  /* Message Bubbles */
  .message {
    display: flex;
    margin-bottom: 16px;
    max-width: 80%;
  }

  .user-message {
    margin-left: auto;
    justify-content: flex-end;
  }

  .bot-message {
    margin-right: auto;
    justify-content: flex-start;
  }

  .message-avatar {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    object-fit: cover;
    margin: 0 8px;
  }

  .message-bubble {
    padding: 12px 16px;
    border-radius: 18px;
    font-size: 14px;
    line-height: 1.4;
    word-wrap: break-word;
  }

  .user-message .message-bubble {
    background: #4361ee;
    color: white;
    border-bottom-right-radius: 4px;
  }

  .bot-message .message-bubble {
    background: white;
    color: #333;
    border: 1px solid #e0e0e0;
    border-bottom-left-radius: 4px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
  }

  /* Input Area */
  .input-area {
    display: flex;
    padding: 12px;
    background: white;
    border-top: 1px solid #e0e0e0;
  }

  .message-input {
    flex: 1;
    border: 1px solid #e0e0e0;
    border-radius: 24px;
    padding: 10px 16px;
    font-size: 14px;
    outline: none;
    transition: border 0.2s;
  }

  .message-input:focus {
    border-color: #4361ee;
  }

  .send-btn {
    background: #4361ee;
    color: white;
    border: none;
    border-radius: 50%;
    width: 40px;
    height: 40px;
    margin-left: 8px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background 0.2s;
  }

  .send-btn:hover {
    background: #3a0ca3;
  }

  /* Typing Indicator */
  .typing-indicator {
    display: flex;
    padding: 12px 16px;
    background: white;
    border-radius: 18px;
    margin-bottom: 16px;
    width: fit-content;
    border: 1px solid #e0e0e0;
  }

  .typing-dot {
    width: 8px;
    height: 8px;
    background: #ccc;
    border-radius: 50%;
    margin: 0 2px;
    animation: typingAnimation 1.4s infinite ease-in-out;
  }

  .typing-dot:nth-child(1) { animation-delay: 0s; }
  .typing-dot:nth-child(2) { animation-delay: 0.2s; }
  .typing-dot:nth-child(3) { animation-delay: 0.4s; }

  @keyframes typingAnimation {
    0%, 60%, 100% { transform: translateY(0); }
    30% { transform: translateY(-5px); background: #666; }
  }

  /* Scrollbar */
  .messages-container::-webkit-scrollbar {
    width: 6px;
  }

  .messages-container::-webkit-scrollbar-track {
    background: #f1f1f1;
  }

  .messages-container::-webkit-scrollbar-thumb {
    background: #ccc;
    border-radius: 3px;
  }

  .messages-container::-webkit-scrollbar-thumb:hover {
    background: #aaa;
  }
</style>

<!-- Floating Chat Section -->
<section style="position: fixed; bottom: 20px; right: 20px; z-index: 1050; width: 360px;">

  <!-- Floating Chat Section -->
<div class="chat-container">
  <!-- Toggle Button -->
  <button id="chatToggleBtn" class="chat-toggle-btn">
    <span>Chat with us</span>
    <i class="fas fa-comment-dots"></i>
  </button>

  <!-- Chat Window -->
  <div id="chatPopup" class="chat-window">
    <!-- Chat Header -->
    <div class="chat-header">
      <div class="chat-title">AI Assistant</div>
      <button id="closeChat" class="close-btn">&times;</button>
    </div>

    <!-- Messages Container -->
    <div class="messages-container" id="chat-messages">
      <!-- Welcome Message -->
      <div class="message bot-message">
        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava1-bg.webp" 
             alt="AI Assistant" class="message-avatar">
        <div class="message-bubble">
          Hello! I'm your AI assistant. How can I help you today?
        </div>
      </div>
      
      <!-- Typing Indicator (hidden by default) -->
      <div id="typingIndicator" class="typing-indicator" style="display: none;">
        <div class="typing-dot"></div>
        <div class="typing-dot"></div>
        <div class="typing-dot"></div>
      </div>
    </div>

    <!-- Input Area -->
    <div class="input-area">
      <input type="text" id="textAreaExample" class="message-input" placeholder="Type your message...">
      <button class="send-btn" id="send-btn">
        <i class="fas fa-paper-plane"></i>
      </button>
    </div>
  </div>
</div>
</section>




<footer id="footer" class="padding-large">
  <div class="container">
    <div class="row">
      <div class="footer-top-area">
        <div class="row d-flex flex-wrap justify-content-between">
          <div class="col-lg-2 col-sm-6 pb-3">
            <div class="footer-menu text-capitalize">
              <ul class="menu-list list-unstyled text-capitalize">
                <li class="menu-item mb-1">
                  <a href="#">Home</a>
                </li>
                <li class="menu-item mb-1">
                  <a href="#">FAQS</a>
                </li>
                <li class="menu-item mb-1">
                  <a href="#">Privacy Policy</a>
                </li>
                <li class="menu-item mb-1">
                  <a href="#">Terms & Condition</a>
                </li>
                <li class="menu-item mb-1">
                  <a href="#">Enquiry</a>
                </li>
              </ul>
            </div>
          </div>
          <div class="col-lg-3 col-sm-6 pb-3">
            <div class="footer-menu">
              <img src="{{asset('images/logo.png')}}" alt="logo" class="img-fluid mb-2" style="height:150px">
            </div>
          </div>
          <div class="col-lg-3 col-sm-6 pb-3">
            <div class="footer-menu contact-item">
              <h5 class="widget-title text-capitalize pb-2">Contact Us</h5>
              <p>Do you have any queries or suggestions? <a href="mailto:"
                  class="text-decoration-underline">booksloaf@gmail.com </a></p>
              <p>If you need support? Just give us a call. <a href="#" class="text-decoration-underline">+60 11 2161 6451</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>
<hr>
<div id="footer-bottom" class="mb-2">
  <div class="container">
    <div class="d-flex flex-wrap justify-content-between">
      <div class="ship-and-payment d-flex gap-md-5 flex-wrap">
        <div class="shipping d-flex">
          <p>We ship with:</p>
          <div class="card-wrap ps-2">
            <img src="{{asset('images/dhl.png')}}" alt="visa">
            <img src="{{asset('images/shippingcard.png')}}" alt="mastercard">
          </div>
        </div>
        <div class="payment-method d-flex">
          <p>Payment options:</p>
          <div class="card-wrap ps-2">
            <img src="{{asset('images/visa.jpg')}}" alt="visa">
            <img src="{{asset('images/mastercard.jpg')}}" alt="mastercard">
            <img src="{{asset('images/paypal.jpg')}}" alt="paypal">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
  crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
<script type="text/javascript" src="{{asset('js/script.js')}}"></script>
<script src="{{ asset('js/country-states.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>



<!-- Chat Logic -->
<script>
   // Chat Logic (updated for new UI)
  const toggleBtn = document.getElementById('chatToggleBtn');
  const chatPopup = document.getElementById('chatPopup');
  const closeChat = document.getElementById('closeChat');
  const sendBtn = document.getElementById('send-btn');
  const input = document.getElementById('textAreaExample');
  const chatMessages = document.getElementById('chat-messages');
  const typingIndicator = document.getElementById('typingIndicator');

  // Toggle chat window
  toggleBtn.addEventListener('click', () => {
    chatPopup.classList.toggle('show');
    if (chatPopup.classList.contains('show')) {
      input.focus();
    }
  });

  // Close chat
  closeChat.addEventListener('click', () => {
    chatPopup.classList.remove('show');
  });

  // Send message on button click or Enter key
  sendBtn.addEventListener('click', sendMessage);
  input.addEventListener('keypress', (e) => {
    if (e.key === 'Enter' && !e.shiftKey) {
      e.preventDefault();
      sendMessage();
    }
  });

  function sendMessage() {
    const message = input.value.trim();
    if (!message) return;

    appendMessage('user', message);
    input.value = '';
    input.disabled = true;
    
    // Show typing indicator
    typingIndicator.style.display = 'flex';
    chatMessages.scrollTop = chatMessages.scrollHeight;

    // Simulate API call with typing delay
    setTimeout(() => {
      fetch("{{ route('chat') }}", {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
          },
          body: JSON.stringify({ message: message })
        })
        .then(res => res.json())
        .then(data => {
          typingIndicator.style.display = 'none';
          appendMessage('bot', data.reply);
          input.disabled = false;
          input.focus();
        })
        .catch(err => {
          typingIndicator.style.display = 'none';
          appendMessage('bot', 'Oops! Something went wrong. Please try again.');
          console.error(err);
          input.disabled = false;
        });
    }, 1000); // 1 second delay to simulate typing
  }

  function appendMessage(sender, text) {
    const messageDiv = document.createElement('div');
    messageDiv.className = `message ${sender}-message`;
    
    const avatar = document.createElement('img');
    avatar.src = sender === 'user'
      ? 'https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava2-bg.webp'
      : 'https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava1-bg.webp';
    avatar.className = 'message-avatar';
    avatar.alt = sender === 'user' ? 'You' : 'AI Assistant';
    
    const bubble = document.createElement('div');
    bubble.className = 'message-bubble';
    bubble.textContent = text;
    
    if (sender === 'user') {
      messageDiv.appendChild(bubble);
      messageDiv.appendChild(avatar);
    } else {
      messageDiv.appendChild(avatar);
      messageDiv.appendChild(bubble);
    }
    
    chatMessages.insertBefore(messageDiv, typingIndicator);
    chatMessages.scrollTop = chatMessages.scrollHeight;
  }
</script>
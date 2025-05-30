<style>
  .collapse-up:not(.show) {
    display: block;
    height: 0;
    overflow: hidden;
    transition: height 0.3s ease-out;
  }

  .collapse-up.show {
    height: auto;
    transition: height 0.3s ease-in;
  }
</style>

<!-- Floating Chat Section -->
<section style="position: fixed; bottom: 20px; right: 20px; z-index: 1050; width: 360px;">

  <!-- Toggle Button -->
  <button id="chatToggleBtn" class="btn btn-info btn-lg w-100">
    <div class="d-flex justify-content-between align-items-center">
      <span>Chat with us</span>
      <i class="fas fa-comments"></i>
    </div>
  </button>

  <!-- Chat Popup (Initially Hidden) -->
  <div id="chatPopup" class="collapse collapse-up mt-2">
    <div class="card" style="max-height: 500px;">

      <!-- Chat Header -->
      <div class="card-header d-flex justify-content-between align-items-center">
        <strong>AI Assistant</strong>
        <button id="closeChat" class="btn btn-sm btn-light">&times;</button>
      </div>

      <!-- Chat Messages -->
      <div class="card-body overflow-auto" id="chat-messages" style="height: 350px;">
        <!-- Messages will be dynamically appended here -->
      </div>

      <!-- Chat Footer -->
      <div class="card-footer d-flex align-items-center gap-2">
        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava5-bg.webp"
          alt="avatar" style="width: 35px;">
        <input type="text" id="textAreaExample" class="form-control" placeholder="Type a message...">
        <button class="btn btn-info" id="send-btn"><i class="fas fa-paper-plane"></i></button>
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
  const toggleBtn = document.getElementById('chatToggleBtn');
  const chatPopup = document.getElementById('chatPopup');
  const closeChat = document.getElementById('closeChat');
  const sendBtn = document.getElementById('send-btn');
  const input = document.getElementById('textAreaExample');
  const chatMessages = document.getElementById('chat-messages');

  toggleBtn.addEventListener('click', () => {
    chatPopup.classList.add('show');
    input.focus();
  });

  closeChat.addEventListener('click', () => {
    chatPopup.classList.remove('show');
  });

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
        appendMessage('bot', data.reply);
        input.disabled = false;
        input.focus();
      })
      .catch(err => {
        appendMessage('bot', 'Oops! Something went wrong.');
        console.error(err);
        input.disabled = false;
      });
  }

  function appendMessage(sender, text) {
    const wrapper = document.createElement('div');
    wrapper.classList.add('d-flex', 'mb-3', sender === 'user' ? 'justify-content-end' : 'justify-content-start');

    const avatar = document.createElement('img');
    avatar.src = sender === 'user'
      ? 'https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava2-bg.webp'
      : 'https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava1-bg.webp';
    avatar.style.width = '35px';
    avatar.classList.add(sender === 'user' ? 'ms-2' : 'me-2');

    const bubble = document.createElement('div');
    bubble.className = 'p-2 small ' + (sender === 'user' ? 'bg-light text-dark' : 'bg-info text-white');
    bubble.style.borderRadius = '15px';
    bubble.textContent = text;

    if (sender === 'user') {
      wrapper.appendChild(bubble);
      wrapper.appendChild(avatar);
    } else {
      wrapper.appendChild(avatar);
      wrapper.appendChild(bubble);
    }

    chatMessages.appendChild(wrapper);
    chatMessages.scrollTop = chatMessages.scrollHeight;
  }
</script>
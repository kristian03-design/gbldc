// Toggle chatbot visibility
function toggleChatbot() {
    const chatbotWidget = document.getElementById('chatbot-widget');
    const chatMessages = document.getElementById('chat-messages');
    const chatForm = document.getElementById('chat-form');
    const chatInput = document.getElementById('chat-input');
    const typingIndicator = document.getElementById('typing-indicator');

    // Predefined questions
    const questions = [
        'What loan services do you offer?',
        'How can I apply for membership?',
        'What are the benefits of being a member?',
        'Do you offer insurance services?',
        'Can I make deposits or savings?',
        'What social services are available?'
    ];

    // Helper: Show typing indicator
    function showTypingIndicator() {
        if (typingIndicator) typingIndicator.classList.remove('hidden');
    }
    // Helper: Hide typing indicator
    function hideTypingIndicator() {
        if (typingIndicator) typingIndicator.classList.add('hidden');
    }

    // Helper: Scroll to bottom
    function scrollToBottom() {
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    // Helper: Add quick questions
    function addQuickQuestions() {
        if (chatMessages.dataset.questionsAdded) return;
        questions.forEach(question => {
            const questionElement = document.createElement('div');
            questionElement.className = 'bg-gray-100 p-2 rounded-md self-start cursor-pointer hover:bg-gray-200 mt-1';
            questionElement.textContent = question;
            questionElement.addEventListener('click', () => {
                // Remove all quick questions from chatMessages
                const allQuestions = chatMessages.querySelectorAll('.bg-gray-100');
                allQuestions.forEach(el => el.remove());
                chatInput.value = question;
                handleUserMessage(question);
            });
            chatMessages.appendChild(questionElement);
        });
        chatMessages.dataset.questionsAdded = 'true';
    }

    // Helper: Show quick questions again (only if you want to show them after bot response)
    function showQuickQuestions() {
        // Do nothing, or remove this function if you don't want to show questions again
        // If you want to show them again, uncomment below:
        // addQuickQuestions();
    }

    // Handle user message
    function handleUserMessage(message) {
        // Append user message
        const userMsg = document.createElement('div');
        userMsg.className = 'flex items-start gap-2 justify-end';
        userMsg.innerHTML = `
            <div class="bg-green-200 text-black px-4 py-2 rounded-2xl rounded-br-none shadow max-w-[80%] ml-auto text-left">${message}</div>
            <img src="path/images/logocoop-removebg-preview 2.png" alt="You" class="w-7 h-7 rounded-full border border-green-200" style="order:2" />
        `;
        chatMessages.appendChild(userMsg);
        scrollToBottom();

        // Show typing indicator
        showTypingIndicator();

        // Simulate bot response after 1s
        setTimeout(() => {
            hideTypingIndicator();
            const botMsg = document.createElement('div');
            botMsg.className = 'flex items-start gap-2';
            let botResponse;
            if (message === questions[0]) {
                botResponse = 'We offer a variety of loan services including personal loans, business loans, and educational loans. Visit our Loans page for more details.';
            } else if (message === questions[1]) {
                botResponse = 'You can apply for membership by filling out the application form on our Apply Now page. Our staff will guide you through the process.';
            } else if (message === questions[2]) {
                botResponse = 'As a member, you enjoy access to loans, savings and deposit plans, insurance products, and social services tailored to your needs.';
            } else if (message === questions[3]) {
                botResponse = 'Yes, we offer insurance services to help protect you and your family. Please visit our Insurance page or contact us for more information.';
            } else if (message === questions[4]) {
                botResponse = 'Absolutely! We provide deposit and savings services to help you manage and grow your finances securely.';
            } else if (message === questions[5]) {
                botResponse = 'We offer various social services including community outreach, financial literacy programs, and member support initiatives.';
            } else {
                botResponse = 'Thank you for your message! How can I assist you?';
            }
            botMsg.innerHTML = `
                <img src="path/images/logocoop-removebg-preview 2.png" alt="GBLDC" class="w-7 h-7 rounded-full border border-green-200" />
                <div class="bg-green-200 text-black px-4 py-2 rounded-2xl rounded-bl-none shadow max-w-[80%] text-left">
                    ${botResponse}
                </div>
            `;
            chatMessages.appendChild(botMsg);
            // Do not show quick questions again after answer
            scrollToBottom();
        }, 1000);

        // Clear input field
        chatInput.value = '';
    }

    // Reset chat on close
    if (!chatbotWidget.classList.contains('hidden')) {
        chatMessages.innerHTML = '';
        delete chatMessages.dataset.questionsAdded;
    }

    chatbotWidget.classList.toggle('hidden');

    // Add quick questions if opening
    if (!chatbotWidget.classList.contains('hidden')) {
        addQuickQuestions();
        scrollToBottom();
    }

    // Prevent duplicate event listeners
    if (!chatForm.dataset.listenerAdded) {
        chatForm.addEventListener('submit', function (e) {
            e.preventDefault();
            const userMessage = chatInput.value.trim();
            if (userMessage) {
                // Remove quick questions after user submits
                const questionElements = chatMessages.querySelectorAll('.bg-gray-100');
                questionElements.forEach(el => el.remove());
                handleUserMessage(userMessage);
            }
        });
        chatForm.dataset.listenerAdded = 'true';
    }
}


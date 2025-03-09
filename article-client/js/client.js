const pages = {};

pages.baseUrl = "http://localhost/faqs/article-server/connection/user/v1/APIs/";

pages.loadFor = (page) => {
    eval(`pages.page${page}()`);
}

const displayMessage = (success,message) => {
    const message_container = document.getElementById('message-container');
    if (message_container) {
        message_container.innerText = message;
        message_container.style.color = success ? 'green' : 'red';
    }
}

class Question {
    constructor(question, answer) {
        this.question = question;
        this.answer = answer;
    }

    displayQuestionCard() {
        return `<div class="card">
                        <div class="front">
                            <p class="label">Question</p>
                            <p class="front-content">${this.question}</p>
                        </div>
                        <div class="back">
                            <p class="label">Answer</p>
                            <p class="back-content">${this.answer}</p>
                        </div>
                </div>`
    }
}


pages.pageSignup = () => {
    const signupButton = document.getElementById('signup-button');
    signupButton.addEventListener('click', handleSignup);
}

const handleSignup =   async() => {
    const username = document.getElementById('username').value;
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    

    const formData = new FormData();
    formData.append('username', username);
    formData.append('email', email);
    formData.append('password', password);

    try {
        const response = await axios.post(`${pages.baseUrl}signup.php`, formData);
        console.log(response);
        if (response.data.success) {
            displayMessage(true, 'Signed up successfully');
            window.location.href = "home.html";

        } else {
            displayMessage( false, response.data.message,);
        }

    } catch (error) {
        console.error('Signup failed:', error);
        displayMessage('An error occurred during signup.', false);
    }
}

pages.pageLogin = () => {
    const loginButton = document.getElementById('login-button')
    loginButton.addEventListener('click', handleLogin);
}

const handleLogin = async () => {
    const password = document.getElementById('password').value;
    const email = document.getElementById('email').value;
    const formData = new FormData();
    formData.append('password', password);
    formData.append('email', email);

    try {
        const response = await axios.post(`${pages.baseUrl}login.php`, formData);

        if (response.data.success) {
            console.log('Login successfully:');
            displayMessage(true, 'Login successfully');
            window.location.href = "html/home.html";
 
        } else {
            displayMessage(false, response.data.message);
        }
    } catch (error) {
        console.error('Login failed:', error);
        displayMessage(false, 'An error occurred during login.');
    }
}
pages.pageHome = async () => {
    const searchBar = document.querySelector('.search-bar');
    searchBar.addEventListener('input', handleSearch);

    const button = document.querySelector('.post-button');
    button.addEventListener('click', takeToPost);
    
    try {
        const response = await axios.get(`${pages.baseUrl}getQuestions.php`);
        response.data.message.forEach(q => {

            const question = new Question (q.question, q.answer);
            document.querySelector('.card-container').innerHTML += question.displayQuestionCard();           
        });
    } catch (error) {
        console.error('Error: ', error);
    }
    
    
    
}

const handleSearch = async () => {
    const searchQuery = document.querySelector('.search-bar').value;

    if (searchQuery.trim() === '') {
        location.reload();
        return; 
    }

    try {
        const response = await axios.get(`${pages.baseUrl}getQuestions.php?value=${encodeURIComponent(searchQuery)}`);
        console.log(response.data);
        document.querySelector('.card-container').innerHTML = '';

        response.data.message.forEach(q => {
            const question = new Question(q.question, q.answer);
            document.querySelector('.card-container').innerHTML += question.displayQuestionCard();
        });

    } catch (error) {
        console.error('Error during search:', error);
        displayMessage(false, 'Error occurred while searching.');
    }
}


const takeToPost = () => {
    window.location.href = 'post.html';
}


pages.pagePost = () => {
    const postButton = document.getElementById('post-button');
    postButton.addEventListener('click',handlePost)

}
const handlePost = async () => {
    const question = document.getElementById('question').value;
    const answer = document.getElementById('answer').value;

     
    if (!question || !answer) {
        displayMessage(false,'Missing information');
        return;
    }

    const formData = new FormData();
    formData.append('question', question);
    formData.append('answer', answer);

    try {
        const response = await axios.post(`${pages.baseUrl}addQuestions.php`, formData);
        displayMessage(response.data.success, response.data.message);
    } catch (error) {
        console.error("Error" . error)
    }
}


export default function loginPage(){
    return `
        <div id="login-container">
            <div><input type="text" id="email" placeholder="Email"/></div>
            <div><input type="password" id="password" placeholder="Password"/></div>
            <button id="loginBtn" class="custom-btn">登入</button>
            <div id="loginMessage"></div>
        </div>
    `;
}

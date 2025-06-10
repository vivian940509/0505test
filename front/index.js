import startPage from './startPage.js';
import employeeInfo from './employeeInfo.js';
import productInfo from './productInfo.js';
import roleInfo from './roleInfo.js';
import supplierInfo from './supplierInfo.js';
import loginPage from './loginPage.js';

function attachEvents(){
    document.getElementById('employee').onclick = employeeInfo;
    document.getElementById('product').onclick = productInfo;
    document.getElementById('role').onclick = roleInfo;
    document.getElementById('supplier').onclick = supplierInfo;
}

function showStartPage(){
    document.getElementById('root').innerHTML = startPage();
    attachEvents();
}

function showLogin(){
    document.getElementById('root').innerHTML = loginPage();
    document.getElementById('loginBtn').onclick = doLogin;
}

function doLogin(){
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    axios.post('../backend/public/index.php?action=doLogin', Qs.stringify({email, password}))
        .then(res => {
            const data = res.data;
            if(data.status === 200){
                const token = data.token;
                localStorage.setItem('token', token);
                axios.defaults.headers.common['Authorization'] = 'Bearer ' + token;
                showStartPage();
            }else{
                document.getElementById('loginMessage').innerText = data.message;
            }
        })
        .catch(err => {
            document.getElementById('loginMessage').innerText = err;
        });
}

axios.interceptors.response.use(function(response){
    if(response.data && response.data.token){
        const newToken = response.data.token;
        localStorage.setItem('token', newToken);
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + newToken;
    }
    if(response.data && (response.data.status === 401 || response.data.status === 403)){
        localStorage.removeItem('token');
        showLogin();
    }
    return response;
});

window.onload = function(){
    const token = localStorage.getItem('token');
    if(token){
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + token;
        showStartPage();
    }else{
        showLogin();
    }
};

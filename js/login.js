const form = document.getElementById('form');
const email = document.getElementById('Username');
const password = document.getElementById('Userpassword');
var val = false;
form.addEventListener('submit', e => {
    validateInputs();
    
    if(!val)
    {
        e.preventDefault();
    }
});

const setError = (element, message) => {
    const inputControl = element.parentElement;
    const errorDisplay = inputControl.querySelector('.error');
    errorDisplay.innerText = message;
    inputControl.classList.add('error');
    inputControl.classList.remove('success');
    
}

const setSuccess = element => {
    const inputControl = element.parentElement;
    const errorDisplay = inputControl.querySelector('.error');
    errorDisplay.innerText = '';
    inputControl.classList.add('success');
    inputControl.classList.remove('error');
};

const isValidPassword = password =>{
    const pwd = /(?=.{8,})(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[*/&^%$#@!])/;
    return pwd.test(password);
}
const isValidEmail = email => {
    const re = /^([a-zA-Z0-9_.]+)@([a-zA-Z0-9_\-]+)(\.[a-zA-Z]{2,5}){1,2}$/;
    return re.test(String(email).toLowerCase());
}

const validateInputs = () => {
    const emailValue = email.value.trim();
    const passwordValue = password.value.trim();
    if(emailValue === '') {
        setError(email, 'Email is required');
    } else if (!isValidEmail(emailValue)) {
        setError(email, 'Please provide a valid email address');
    } else {
        setSuccess(email);
    }

    if(passwordValue === '') {
        setError(password, 'Password is required'+'\n');
    } else if (!isValidPassword(passwordValue)) {
        setError(password, 'Password must contain :'+ '\n'+  'A minimum of 8 characters' + '\n'+  'At least 1 upper case letter (A-Z)'+ '\n'+ 'At least 1 lower case letter (a-z)'+'\n'+ 'At least 1 digit (0-9)'+'\n'+' At least 1 non-alphanumeric symbol (e.g @,!,#,$,%,*'+'\n')
    } 
    else {
        setSuccess(password);
        val=true;

    }
 

};

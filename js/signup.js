const form = document.getElementById('form');
const name = document.getElementById('FirstName');
const surname = document.getElementById('LastName');
const email = document.getElementById('Email');
const password = document.getElementById('Password');
var val=false;
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
    inputControl.classList.remove('success')
}

const setSuccess = element => {
    const inputControl = element.parentElement;
    const errorDisplay = inputControl.querySelector('.error');
    errorDisplay.innerText = '';
    inputControl.classList.add('success');
    inputControl.classList.remove('error');
    val=true;

};

const isValidPassword = password =>{
    const pwd = /(?=.{8,})(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[*/&^%$#@!])/;
    return pwd.test(password);
}
const isValidEmail = email => {
    const re = /^([a-zA-Z0-9_.]+)@([a-zA-Z0-9_\-]+)(\.[a-zA-Z]{2,5}){1,2}$/;
    return re.test(String(email).toLowerCase());
}
const isValidName = name =>{
    const validName = /^[A-Z][a-z]*$/;
    return validName.test(name);
}
const isValidSurname = surname =>{
    const validSurname = /^[A-Z][a-z]*$/;
    return validSurname.test(surname); 
}
const validateInputs = () => {
    const nameValue = name.value.trim();
    const surnameValue = surname.value.trim();
    const emailValue = email.value.trim();
    const passwordValue = password.value.trim();
    if(nameValue === '') {
        setError(name, 'Name is required');
    } 
    else if(!isValidName(nameValue)){
        setError(name, 'Please enter a valid name . Only letters and white space are allowed (Note : the first letter must be in upper case)');
    }
    else {
        setSuccess(name);
    }

    if(surnameValue === '') {
        setError(surname, 'Surname is required');
    } 
    else if(!isValidSurname(surnameValue)){
        setError(surname, 'Please enter a valid surname . Only letters and white space are allowed (Note : the first letter must be in upper case)');
    }
    else {
        setSuccess(surname);
    }
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
    }
 

};

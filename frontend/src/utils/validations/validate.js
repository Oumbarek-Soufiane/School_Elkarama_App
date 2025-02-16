export const validateEmail = (email) => {
    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return regex.test(email);
  };
  
  export const validateStringLength = (str, minLength) => {
    return str.length >= minLength;
  };
  
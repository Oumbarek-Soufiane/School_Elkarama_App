export const getUserTypeInFrench = (userType) => {
  switch (userType) {
    case "student":
      return "Étudiant";
    case "guardian":
      return "Responsable";
    case "admin":
      return "Administrateur";
    case "teacher":
      return "Professeur";
    default:
      return "Utilisateur";
  }
};

export const displayCharacterCount = (str, numChars) => {
  if (str.length <= numChars) {
    return str;
  } else {
    return str.substring(0, numChars) + "...";
  }
};

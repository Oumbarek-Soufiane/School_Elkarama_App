import React from "react";
import classes from "./Button.module.css";

function Button({
  text,
  onClick,
  type = "button",
  className,
  disabled = false,
  backgroundColor,
  textColor,
  size = "medium",
  icon
}) {
  const buttonStyle = {
    backgroundColor: disabled
      ? "var(--alkarama-tertiary-color)"
      : backgroundColor,
    color: textColor || "var(--alkarama-white)",
  };

  return (
    <button
      className={`${classes.button} ${classes[size]} ${className}`} 
      onClick={onClick}
      type={type}
      disabled={disabled}
      style={buttonStyle}
    >
      {icon && <span className={classes.icon}>{icon}</span>}
      {text}
    </button>
  );
}

export default Button;

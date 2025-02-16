import React, { forwardRef } from "react";
import classes from "./Input.module.css";

const Input = forwardRef(function Input(
  { label, type, textarea, selectOptions, errorMessage = null, ...props },
  ref
) {
  return (
    <div className={classes.container}>
      <label className={classes.label}>{label}</label>
      {textarea ? (
        <textarea
          ref={ref}
          className={classes.input}
          {...props}
          placeholder={label}
        />
      ) : selectOptions ? (
        <select ref={ref} className={classes.input} {...props}>
          <option value="" hidden>
            Choisir {label}
          </option>
          {selectOptions.map((option, index) => (
            <option key={index} value={option.value}>
              {option.label}
            </option>
          ))}
        </select>
      ) : (
        <input
          ref={ref}
          className={classes.input}
          type={type}
          placeholder={label}
          {...props}
        />
      )}
      <span className={classes.error_message}>
        {errorMessage && errorMessage}
      </span>
    </div>
  );
});

export default Input;

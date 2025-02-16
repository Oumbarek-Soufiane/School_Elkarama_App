import React from "react";
import classes from "./ThinCard.module.css";

function ThinCard({ title, children }) {
  return (
    <div className={classes.thin_card}>
      {title && (
        <div className={classes.thin_card_header}>
          <h4>{title}</h4>
        </div>
      )}
      <div className={classes.thin_card_body}>
        {children}
      </div>
    </div>
  );
}

export default ThinCard;

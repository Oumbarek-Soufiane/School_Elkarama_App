import React from "react";
import { Image } from "react-bootstrap";
import Card from "./../../UI/cards/Card";
import classes from "./TeamCard.module.css";
import { displayCharacterCount } from "../../../utils";

function TeamCard({ imgSrc, title, description }) {
  return (
    <Card className={`${classes.team_card} bg-light}`}>
      <div className={`${classes.team_img_conatiner}`}>
        <Image src={imgSrc} fluid rounded className={`${classes.team_img}`} />
      </div>
      <h4 className={`${classes.team_title} mt-3`}>{title}</h4>
      <p>{displayCharacterCount(description, 20)}</p>
    </Card>
  );
}

export default TeamCard;

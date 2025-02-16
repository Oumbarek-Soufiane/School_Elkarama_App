import React from "react";
import Card from "../../UI/cards/Card";
import Button from "./../../UI/buttons/Button";
import { Image } from "react-bootstrap";
import { FaLongArrowAltRight } from "react-icons/fa";
import classes from "./ActivityCard.module.css";
import { displayCharacterCount } from "../../../utils";

function ActivityCard({ imgSrc, title, description }) {
  return (
    <Card className={`${classes.activity_container} bg-white`}>
      <div className={`${classes.activity_img_container} rounded-top`}>
        <Image
          className={`${classes.activity_img}`}
          src={imgSrc}
          style={{ width: "100%" }}
          fluid
        />
      </div>
      <div className="shadow-sm p-1">
        <h4 className={`mt-2 ${classes.title}`}>{title}</h4>
        <p>{displayCharacterCount(description, 50)}</p>
        <div className="w-100 text-end">
          <Button
            text="Plus"
            type="button"
            className="px-4"
            backgroundColor="var(--alkarama-primary-color)"
            textColor=""
            size="small"
            icon={<FaLongArrowAltRight />}
          />
        </div>
      </div>
    </Card>
  );
}

export default ActivityCard;

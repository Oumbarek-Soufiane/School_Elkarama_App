import React from "react";
import Card from "../../UI/cards/Card";
import Button from "./../../UI/buttons/Button";
import { Image } from "react-bootstrap";
import { displayCharacterCount } from "../../../utils";
import { FaLongArrowAltRight } from "react-icons/fa";
import classes from "./ProgramCard.module.css";
function ProgramCard({
  imgSrc,
  imgTeacherSrc,
  teacherName,
  title,
  description,
}) {
  return (
    <Card className="bg-white">
      <div className={`${classes.program_img_conatiner} rounded-top`}>
        <Image
          className={`${classes.program_img}`}
          src={imgSrc}
          style={{ width: "100%" }}
          fluid
        />
      </div>
      <div className="shadow-sm p-1">
        <div className="d-flex align-items-center">
          <div className={`${classes.program_profile_conatiner}`}>
            <Image
              src={imgTeacherSrc}
              roundedCircle
              fluid
              className={`${classes.program_img}`}
            />
          </div>
          <span className="ms-2">{teacherName}</span>
        </div>
        <h4 className={`mt-2 ${classes.title}`}>{title}</h4>
        <p>{displayCharacterCount(description, 45)}</p>
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

export default ProgramCard;

import React, { useEffect } from "react";
import { useDispatch } from "react-redux";
import { setUserType } from "../../redux/slices/userTypeSlice";
import classes from "./LoginHeader.module.css";
import Button from "./../UI/buttons/Button";
import { Link, useSearchParams, useNavigate } from "react-router-dom";
import { MdAdminPanelSettings } from "react-icons/md";
import { FaUserGraduate, FaUserShield } from "react-icons/fa";
import { LiaChalkboardTeacherSolid } from "react-icons/lia";

function LoginHeader() {
  const dispatch = useDispatch();
  const navigate = useNavigate();
  const [searchParams, setSearchParams] = useSearchParams();

  const handleButtonClick = (type) => {
    dispatch(setUserType(type));
    setSearchParams({ user: type });
  };

  useEffect(() => {
    navigate(`?user=student`);
  }, [navigate]);

  return (
    <div className="d-flex flex-wrap justify-content-center mb-3">
      <Link
        to={`?user=student`}
        onClick={() => handleButtonClick("student")}
        className={classes.styledButton}
      >
        <Button
          size="small"
          text="Étudiant"
          backgroundColor="var(--alkarama-primary-color)"
          textColor="var(--alkarama-white)"
          icon={<FaUserGraduate />}
        />
      </Link>
      <Link
        to={`?user=guardian`}
        onClick={() => handleButtonClick("guardian")}
        className={classes.styledButton}
      >
        <Button
          size="small"
          text="Tuteur"
          backgroundColor="var(--alkarama-primary-color)"
          textColor="var(--alkarama-white)"
          icon={<FaUserShield />}
        />
      </Link>
      <Link
        to={`?user=admin`}
        onClick={() => handleButtonClick("admin")}
        className={classes.styledButton}
      >
        <Button
          size="small"
          text="Administrateur"
          backgroundColor="var(--alkarama-primary-color)"
          textColor="var(--alkarama-white)"
          icon={<MdAdminPanelSettings />}
        />
      </Link>
      <Link
        to={`?user=teacher`}
        onClick={() => handleButtonClick("teacher")}
        className={classes.styledButton}
      >
        <Button
          size="small"
          text="Professeur"
          backgroundColor="var(--alkarama-primary-color)"
          textColor="var(--alkarama-white)"
          icon={<LiaChalkboardTeacherSolid />}
        />
      </Link>
    </div>
  );
}

export default LoginHeader;

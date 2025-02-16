import React, { useEffect, Fragment } from "react";
import Input from "./../UI/inputs/Input";
import Button from "../UI/buttons/Button";
import { BsDatabaseFill } from "react-icons/bs";
import { useActionData, Form, useNavigate } from "react-router-dom";
import { useDispatch } from "react-redux";
import { setSuccessMessage } from "../../redux/slices/successMessageSlice";

function SchoolYearForm({ method, year }) {
  const actionData = useActionData();
  const navigate = useNavigate();
  const dispatch = useDispatch();

  useEffect(() => {
    if (actionData && actionData.message) {
      dispatch(setSuccessMessage(actionData.message));
      navigate("/admin/school-years/list");
    }
  }, [actionData, navigate, dispatch]);

  return (
    <Fragment>
      <Form method={method}>
        <Input
          label="Année scolaire"
          type="text"
          name="name"
          defaultValue={year ? year.name : ""}
          errorMessage={actionData && actionData.error}
          required
        />
        <Input
          textarea
          label="Description"
          type="text"
          name="description"
          defaultValue={year ? year.description : ""}
          required
        />
        <Button
          text="Soumettre"
          type="submit"
          className="fw-bold float-lg-start me-2"
          backgroundColor="var(--alkarama-primary-color)"
          icon={<BsDatabaseFill />}
        />
      </Form>
    </Fragment>
  );
}

export default SchoolYearForm;

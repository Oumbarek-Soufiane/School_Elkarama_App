import React, { useEffect, Fragment } from "react";
import Input from "../UI/inputs/Input";
import Button from "../UI/buttons/Button";
import { BsDatabaseFill } from "react-icons/bs";
import { useActionData, Form, useNavigate } from "react-router-dom";
import { useDispatch } from "react-redux";
import { setSuccessMessage } from "../../redux/slices/successMessageSlice";

function SubjectForm({ method, subject }) {
  const actionData = useActionData();
  const navigate = useNavigate();
  const dispatch = useDispatch();

  useEffect(() => {
    if (actionData && actionData.message) {
      dispatch(setSuccessMessage(actionData.message));
      navigate("/admin/subjects/list");
    }
  }, [actionData, navigate, dispatch]);

  return (
    <Fragment>
      <Form method={method}>
        <Input
          label="Matière" 
          type="text"
          name="name"
          defaultValue={subject ? subject.name : ""}
          errorMessage={actionData && actionData.error}
          required
        />
        <Input
          textarea
          label="Description"
          type="text"
          name="description"
          defaultValue={subject ? subject.description : ""}
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

export default SubjectForm;

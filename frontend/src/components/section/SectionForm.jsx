import React, { useEffect, Fragment } from "react";
import Input from "./../UI/inputs/Input";
import Button from "../UI/buttons/Button";
import { BsDatabaseFill } from "react-icons/bs";
import { useActionData, Form, useNavigate } from "react-router-dom";
import { useDispatch } from "react-redux";
import { setSuccessMessage } from "../../redux/slices/successMessageSlice";

function SectionForm({ method, levels, section }) {
  const actionData = useActionData();
  const navigate = useNavigate();
  const dispatch = useDispatch();

  useEffect(() => {
    if (actionData && actionData.message) {
      dispatch(setSuccessMessage(actionData.message));
      navigate("/admin/sections/list");
    }
  }, [actionData, navigate, dispatch]);

  return (
    <Fragment>
      <Form method={method}>
        <Input
          label="Niveau"
          name="level_id"
          type="select"
          selectOptions={levels.map(level => ({ value: level.id, label: level.name }))}
          defaultValue={section ? section.level_id : ""}
          errorMessage={actionData && actionData.error && actionData.error.level_id}
          required
        />
        <Input
          label="Nom de la Classe"
          type="text"
          name="name"
          defaultValue={section ? section.name : ""}
          errorMessage={actionData && actionData.error && actionData.error.name}
          required
        />
        <Input
          textarea
          label="Description"
          name="description"
          defaultValue={section ? section.description : ""}
          errorMessage={actionData && actionData.error && actionData.error.description}
          required
        />
        <Input
          label="Frais de Scolarité par Mois"
          type="number"
          name="school_fees_per_month"
          defaultValue={section ? section.school_fees_per_month : ""}
          errorMessage={actionData && actionData.error && actionData.error.school_fees_per_month}
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

export default SectionForm;

import React, { useEffect, Fragment } from "react";
import Input from "./../UI/inputs/Input";
import Button from "../UI/buttons/Button";
import { BsDatabaseFill } from "react-icons/bs";
import { useActionData, Form, useNavigate } from "react-router-dom";
import { useDispatch } from "react-redux";
import { setSuccessMessage } from "../../redux/slices/successMessageSlice";

function GroupForm({ method, sections, group }) {
  const actionData = useActionData();
  const navigate = useNavigate();
  const dispatch = useDispatch();

  useEffect(() => {
    if (actionData && actionData.message) {
      dispatch(setSuccessMessage(actionData.message));
      navigate("/admin/groups/list");
    }
  }, [actionData, navigate, dispatch]);

  return (
    <Fragment>
      <Form method={method}>
        <Input
          label="Classe"
          name="section_id"
          type="select"
          selectOptions={sections.map((section) => ({
            value: section.id,
            label: section.name,
          }))}
          defaultValue={group ? group.section_id : ""}
          errorMessage={
            actionData && actionData.error && actionData.error.section_id
          }
          required
        />
        <Input
          label="Nom du groupe"
          type="text"
          name="name"
          defaultValue={group ? group.name : ""}
          errorMessage={actionData && actionData.error && actionData.error.name}
          required
        />
        <Input
          textarea
          label="Description"
          name="description"
          defaultValue={group ? group.description : ""}
          errorMessage={
            actionData && actionData.error && actionData.error.description
          }
          required
        />
        <Input
          label="capacite"
          type="number"
          name="capacity"
          defaultValue={group ? group.capacity : ""}
          errorMessage={
            actionData && actionData.error && actionData.error.capacity
          }
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

export default GroupForm;

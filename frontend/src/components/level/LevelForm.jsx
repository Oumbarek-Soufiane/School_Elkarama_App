import React, { useState, useEffect, Fragment } from "react";
import Input from "./../UI/inputs/Input";
import Button from "../UI/buttons/Button";
import { BsDatabaseFill } from "react-icons/bs";
import { useActionData, Form, useNavigate } from "react-router-dom";
import { useDispatch } from "react-redux";
import { setSuccessMessage } from "../../redux/slices/successMessageSlice";

function LevelForm({ method, level }) {
  const actionData = useActionData();
  const navigate = useNavigate();
  const dispatch = useDispatch();
  const [levelImage, setLevelImage] = useState(null);
  const [responsibleImage, setResponsibleImage] = useState(null);

  useEffect(() => {
    if (actionData && actionData.message) {
      dispatch(setSuccessMessage(actionData.message));
      navigate("/admin/levels/list");
    }
  }, [actionData, navigate, dispatch]);

  const handleLevelImageChange = (e) => setLevelImage(e.target.files[0]);
  const handleResponsibleImageChange = (e) =>
    setResponsibleImage(e.target.files[0]);

  return (
    <Fragment>
      <Form method={method} encType="multipart/form-data">
        <Input
          label="Nom du niveau"
          type="text"
          name="name"
          defaultValue={level ? level.name : ""}
          errorMessage={actionData && actionData.errors?.name}
        />
        <Input
          textarea
          label="Description"
          name="description"
          defaultValue={level ? level.description : ""}
          errorMessage={actionData && actionData.errors?.description}
        />
        <Input
          label="Nom du responsable"
          type="text"
          name="responsible_name"
          defaultValue={level ? level.responsible_name : ""}
          errorMessage={actionData && actionData.errors?.responsible_name}
        />
        <Input
          label="Image du niveau"
          type="file"
          name="level_image"
          onChange={handleLevelImageChange}
          errorMessage={actionData && actionData.errors?.level_image}
        />
        <Input
          label="Image du responsable"
          type="file"
          name="responsible_image"
          onChange={handleResponsibleImageChange}
          errorMessage={actionData && actionData.errors?.responsible_image}
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

export default LevelForm;

import React, { useEffect, Fragment } from "react";
import Input from "./../UI/inputs/Input";
import Button from "../UI/buttons/Button";
import { BsDatabaseFill } from "react-icons/bs";
import { useActionData, Form, useNavigate } from "react-router-dom";
import { useDispatch } from "react-redux";
import { setSuccessMessage } from "../../redux/slices/successMessageSlice";

function ClassRoomForm({ method, room }) {
  const actionData = useActionData();
  const navigate = useNavigate();
  const dispatch = useDispatch();

  useEffect(() => {
    console.log(actionData ? actionData.errors : "x");
    if (actionData && actionData.message && !actionData.errors) {
      dispatch(setSuccessMessage(actionData.message));
      navigate("/admin/class-rooms/list");
    }
  }, [actionData, navigate, dispatch]);

  return (
    <Fragment>
      <Form method={method}>
        <Input
          label="Numero de salle"
          type="text"
          name="number"
          defaultValue={room ? room.number : ""}
          errorMessage={actionData?.errors?.number}
        />
        <Input
          textarea
          label="Description"
          name="description"
          defaultValue={room ? room.description : ""}
          errorMessage={actionData?.errors?.description}
        />
        <Input
          label="Capacite"
          type="number"
          name="capacity"
          defaultValue={room ? room.capacity : ""}
          errorMessage={actionData?.errors?.capacity}
        />
        <Input
          name="type"
          label="Type"
          selectOptions={[
            { value: "classroom", label: "classroom" },
            { value: "amphitheater", label: "amphitheater" },
            { value: "gym", label: "gym" },
            { value: "lab", label: "lab" },
            { value: "office", label: "office" },
          ]}
          errorMessage={actionData?.errors}
        />
        <Input
          name="availability"
          label="availability"
          selectOptions={[
            { value: "1", label: "Oui" },
            { value: "0", label: "Non" },
          ]}
          errorMessage={actionData?.errors?.availability}
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

export default ClassRoomForm;

import React, { useEffect, useState, Fragment } from "react";
import Input from "../UI/inputs/Input";
import Button from "../UI/buttons/Button";
import { BsDatabaseFill } from "react-icons/bs";
import { useActionData, Form, useNavigate } from "react-router-dom";
import { useDispatch } from "react-redux";
import { setSuccessMessage } from "../../redux/slices/successMessageSlice";
import { Container, Row, Col } from "react-bootstrap";

function AdminForm({ method, admin }) {
  const actionData = useActionData();
  const navigate = useNavigate();
  const dispatch = useDispatch();
  const [adminImage, setAdminImage] = useState(null);

  useEffect(() => {
    if (actionData && actionData.message && !actionData.errors) {
      dispatch(setSuccessMessage(actionData.message));
      navigate("/admin/admins/list");
    }
  }, [actionData, navigate, dispatch]);

  const handleAdminImageChange = (e) => {
    setAdminImage(e.target.files[0]);
  };

  return (
    <Fragment>
      <Form method={method} encType="multipart/form-data">
        <Container>
          <Row>
            <Col lg={6}>
              <Input
                label="CIN"
                type="text"
                name="cin"
                defaultValue={admin ? admin.cin : ""}
                errorMessage={actionData && actionData.errors?.cin?.[0]}
                required
              />
            </Col>
            <Col lg={6}>
              <Input
                label="Prénom"
                type="text"
                name="first_name"
                defaultValue={admin ? admin.first_name : ""}
                errorMessage={actionData && actionData.errors?.first_name?.[0]}
                required
              />
            </Col>
            <Col lg={6}>
              <Input
                label="Nom"
                type="text"
                name="last_name"
                defaultValue={admin ? admin.last_name : ""}
                errorMessage={actionData && actionData.errors?.last_name?.[0]}
                required
              />
            </Col>
            <Col lg={6}>
              <Input
                label="Date de naissance"
                type="date"
                name="date_of_birth"
                defaultValue={admin ? admin.date_of_birth : ""}
                errorMessage={
                  actionData && actionData.errors?.date_of_birth?.[0]
                }
                required
              />
            </Col>
            <Col lg={6}>
              <Input
                label="Genre"
                selectOptions={[
                  { value: "male", label: "Masculin" },
                  { value: "female", label: "Féminin" },
                ]}
                name="gender"
                defaultValue={admin ? admin.gender : ""}
                errorMessage={actionData && actionData.errors?.gender?.[0]}
                required
              />
            </Col>
            <Col lg={6}>
              <Input
                label="Rôle"
                selectOptions={[
                  { value: "admin", label: "Administrateur" },
                  { value: "super_admin", label: "Super Administrateur" },
                ]}
                name="role"
                defaultValue={admin ? admin.role : ""}
                errorMessage={actionData && actionData.errors?.role?.[0]}
                required
              />
            </Col>
            <Col lg={12}>
              <Input
                label="Email"
                type="email"
                name="email"
                defaultValue={admin ? admin.email : ""}
                errorMessage={actionData && actionData.errors?.email?.[0]}
                
                required
              />
            </Col>
            <Col lg={12}>
              <Input
                label="Téléphone"
                type="text"
                name="phone"
                defaultValue={admin ? admin.phone : ""}
                errorMessage={actionData && actionData.errors?.phone?.[0]}
                required
              />
            </Col>
            <Col lg={12}>
              <Input
                label="Adresse"
                type="text"
                name="address"
                defaultValue={admin ? admin.address : ""}
                errorMessage={actionData && actionData.errors?.address?.[0]}
                required
              />
            </Col>
            <Col lg={12}>
              <Input
                label="Image"
                type="file"
                name="image"
                onChange={handleAdminImageChange}
                errorMessage={actionData && actionData.errors?.image?.[0]}
              />
            </Col>
            <Col lg={12}>
              <Button
                text="Soumettre"
                type="submit"
                className="fw-bold float-lg-start me-2"
                backgroundColor="var(--alkarama-primary-color)"
                icon={<BsDatabaseFill />}
              />
            </Col>
          </Row>
        </Container>
      </Form>
    </Fragment>
  );
}

export default AdminForm;

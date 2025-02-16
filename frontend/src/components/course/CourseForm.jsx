import React, { useEffect, Fragment } from "react";
import { Container, Row, Col } from "react-bootstrap";
import { BsDatabaseFill } from "react-icons/bs";
import { Form, useNavigate, useActionData } from "react-router-dom";
import { useDispatch } from "react-redux";
import Input from "./../UI/inputs/Input";
import Button from "../UI/buttons/Button";
import { setSuccessMessage } from "../../redux/slices/successMessageSlice";

function CourseForm({ method, groups, subjects, course }) {
  const actionData = useActionData();
  const navigate = useNavigate();
  const dispatch = useDispatch();
  
  useEffect(() => {
    if (actionData && actionData.message) {
      dispatch(setSuccessMessage(actionData.message));
      navigate("/teacher/courses/list");
    }
  }, [actionData, navigate, dispatch]);

  return (
    <Fragment>
      <Container>
        <Form method={method} encType="multipart/form-data">
          <Row>
            <Col lg={6} md={12} sm={12}>
              <Input
                label="Groupe"
                name="group_id"
                type="select"
                selectOptions={groups.map((group) => ({
                  value: group.id,
                  label: group.name,
                }))}
                defaultValue={course ? course.group_id : ""}
                errorMessage={
                  actionData &&
                  actionData.errors &&
                  actionData.errors.group_id &&
                  actionData.errors.group_id[0]
                }
              />
            </Col>
            <Col lg={6} md={12} sm={12}>
              <Input
                label="Matière"
                name="subject_id"
                type="select"
                selectOptions={subjects.map((subject) => ({
                  value: subject.id,
                  label: subject.name,
                }))}
                defaultValue={course ? course.subject_id : ""}
                errorMessage={
                  actionData &&
                  actionData.errors &&
                  actionData.errors.subject_id &&
                  actionData.errors.subject_id[0]
                }
              />
            </Col>
          </Row>
          <Row>
            <Col lg={12} md={12} sm={12}>
              <Input
                label="Nom de cours"
                name="course_name"
                type="text"
                defaultValue={course ? course.course_name : ""}
                errorMessage={
                  actionData &&
                  actionData.errors &&
                  actionData.errors.course_name &&
                  actionData.errors.course_name[0]
                }
              />
            </Col>
            <Col lg={12} md={12} sm={12}>
              <Input
                label="Description"
                name="description"
                textarea
                defaultValue={course ? course.description : ""}
                errorMessage={
                  actionData &&
                  actionData.errors &&
                  actionData.errors.description &&
                  actionData.errors.description[0]
                }
              />
            </Col>
          </Row>
          <Row>
            <Col lg={12} md={12} sm={12}>
              <Input
                label="Type"
                placeholder="Cours, exercices..."
                name="type"
                type="text"
                defaultValue={course ? course.type : ""}
                errorMessage={
                  actionData &&
                  actionData.errors &&
                  actionData.errors.type &&
                  actionData.errors.type[0]
                }
              />
            </Col>
            <Col lg={12} md={12} sm={12}>
              <Input
                label="Fichier (pdf, doc, docx)"
                name="file"
                type="file"
                accept=".pdf, .doc, .docx"
                errorMessage={
                  actionData &&
                  actionData.errors &&
                  actionData.errors.file &&
                  actionData.errors.file[0]
                }
              />
            </Col>
          </Row>
          <Row>
            <Col>
              <Button
                text="Soumettre"
                type="submit"
                className="fw-bold float-lg-start me-2"
                backgroundColor="var(--alkarama-primary-color)"
                icon={<BsDatabaseFill />}
              />
            </Col>
          </Row>
        </Form>
      </Container>
    </Fragment>
  );
}

export default CourseForm;

import React, { useEffect, useState, Fragment } from "react";
import Input from "./../UI/inputs/Input";
import Button from "../UI/buttons/Button";
import { BsDatabaseFill } from "react-icons/bs";
import { useActionData, Form, useNavigate } from "react-router-dom";
import { useDispatch } from "react-redux";
import { setSuccessMessage } from "../../redux/slices/successMessageSlice";
import { Row, Col } from "react-bootstrap";

function EvaluationForm({ method, levels, teachers, evaluation }) {
  const actionData = useActionData();
  const navigate = useNavigate();
  const dispatch = useDispatch();

  const [selectedLevel, setSelectedLevel] = useState(
    evaluation?.level_id || ""
  );
  const [selectedSection, setSelectedSection] = useState(
    evaluation?.section_id || ""
  );
  const [selectedTeacher, setSelectedTeacher] = useState(
    evaluation?.teacher_id || ""
  );
  const [selectedSubject, setSelectedSubject] = useState(
    evaluation?.subject_id || ""
  );

  useEffect(() => {
    if (actionData && actionData.message) {
      dispatch(setSuccessMessage(actionData.message));
      navigate("/admin/evaluations/list");
    }
  }, [actionData, navigate, dispatch]);

  const handleLevelChange = (e) => {
    setSelectedLevel(e.target.value);
    setSelectedSection("");
  };

  const handleSectionChange = (e) => {
    setSelectedSection(e.target.value);
  };

  const handleTeacherChange = (e) => {
    setSelectedTeacher(e.target.value);
    setSelectedSubject("");
  };

  const filteredSections = selectedLevel
    ? levels.find((level) => level.id === parseInt(selectedLevel))?.sections ||
      []
    : [];

  const filteredGroups = selectedSection
    ? filteredSections.find(
        (section) => section.id === parseInt(selectedSection)
      )?.groups || []
    : [];

  const filteredSubjects = selectedTeacher
    ? teachers.find((teacher) => teacher.id === parseInt(selectedTeacher))
        ?.subjects || []
    : [];

  return (
    <Fragment>
      <Form method={method}>
        <Row>
          <Col sm={12} lg={6}>
            <Input
              label="Niveau"
              name="level_id"
              type="select"
              selectOptions={levels.map((level) => ({
                value: level.id,
                label: level.name,
              }))}
              defaultValue={selectedLevel}
              onChange={handleLevelChange}
              errorMessage={
                actionData && actionData.error && actionData.error.level_id
              }
            />
          </Col>
          <Col sm={12} lg={6}>
            <Input
              label="Section"
              name="section_id"
              type="select"
              selectOptions={filteredSections.map((section) => ({
                value: section.id,
                label: section.name,
              }))}
              defaultValue={selectedSection}
              onChange={handleSectionChange}
              errorMessage={
                actionData && actionData.error && actionData.error.section_id
              }
            />
          </Col>
        </Row>
        <Row>
          <Col sm={12} lg={6}>
            <Input
              label="Groupe"
              name="group_id"
              type="select"
              selectOptions={filteredGroups.map((group) => ({
                value: group.id,
                label: group.name,
              }))}
              defaultValue={evaluation ? evaluation.group_id : ""}
              errorMessage={
                actionData && actionData.errors && actionData.errors.group_id
              }
            />
          </Col>
          <Col sm={12} lg={6}>
            <Input
              label="Professeur"
              name="teacher_id"
              type="select"
              selectOptions={teachers.map((teacher) => ({
                value: teacher.id,
                label: `${teacher.teacher_first_name} ${teacher.teacher_last_name}`,
              }))}
              defaultValue={selectedTeacher}
              onChange={handleTeacherChange}
              errorMessage={
                actionData && actionData.error && actionData.error.teacher_id
              }
              required
            />
          </Col>
        </Row>
        <Row>
          <Col sm={12} lg={6}>
            <Input
              label="Matière"
              name="subject_id"
              type="select"
              selectOptions={filteredSubjects.map((subject) => ({
                value: subject.id,
                label: subject.name,
              }))}
              defaultValue={selectedSubject}
              onChange={(e) => setSelectedSubject(e.target.value)}
              errorMessage={
                actionData && actionData.error && actionData.error.subject_id
              }
              required
            />
          </Col>
          <Col sm={12} lg={6}>
            <Input
              label="Numéro d'évaluation"
              name="evaluation_number"
              selectOptions={[
                { value: "1", label: "Evaluation 1"},
                { value: "2", label: "Evaluation 2"}, 
                { value: "3", label: "Evaluation 3"}, 
                { value: "4", label: "Evaluation 4"}, 
              ]}
              defaultValue={evaluation ? evaluation.evaluation_number : ""}
              errorMessage={
                actionData &&
                actionData.error &&
                actionData.error.evaluation_number
              }
              required
            />
          </Col>
        </Row>
        <Row>
          <Col sm={12} lg={6}>
            <Input
              label="Date"
              name="date"
              type="date"
              defaultValue={evaluation ? evaluation.date : ""}
              errorMessage={
                actionData && actionData.error && actionData.error.date
              }
              required
            />
          </Col>
          <Col sm={12} lg={6}>
            <Input
              label="Heure de début"
              name="start_time"
              type="time"
              defaultValue={evaluation ? evaluation.start_time : ""}
              errorMessage={
                actionData && actionData.error && actionData.error.start_time
              }
            />
          </Col>
        </Row>
        <Row>
          <Col sm={12} lg={6}>
            <Input
              label="Heure de fin"
              name="end_time"
              type="time"
              defaultValue={evaluation ? evaluation.end_time : ""}
              errorMessage={
                actionData && actionData.error && actionData.error.end_time
              }
            />
          </Col>
          <Col sm={12} lg={6}>
            <Input
              label="Type"
              name="type"
              type="text"
              defaultValue={evaluation ? evaluation.type : ""}
              errorMessage={
                actionData && actionData.error && actionData.error.type
              }
            />
          </Col>
        </Row>
        <Row>
          <Col sm={12} lg={6}>
            <Input
              label="Semestre"
              name="semester"
              selectOptions={[
                { value: "1", label: "Premier semester" },
                { value: "2", label: "Deuxième semester" }, 
              ]}
              defaultValue={evaluation ? evaluation.semester : ""}
              errorMessage={
                actionData && actionData.error && actionData.error.semester
              }
              required
            />
          </Col>
          <Col sm={12} lg={6}>
            <Input
              label="Statut"
              name="status"
              type="text"
              defaultValue={evaluation ? evaluation.status : ""}
              errorMessage={
                actionData && actionData.error && actionData.error.status
              }
            />
          </Col>
        </Row>
        <Row>
          <Col>
            <Input
              textarea
              label="Description"
              name="description"
              type="description"
              defaultValue={evaluation ? evaluation.description : ""}
              errorMessage={
                actionData && actionData.error && actionData.error.description
              }
            />
          </Col>
        </Row>
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

export default EvaluationForm;

import React, { useEffect, useState, Fragment } from "react";
import axios from "axios";
import { useActionData, Form, useNavigate } from "react-router-dom";
import { BsDatabaseFill } from "react-icons/bs";
import { useDispatch } from "react-redux";
import Input from "./../UI/inputs/Input";
import Button from "../UI/buttons/Button";
import { setSuccessMessage } from "../../redux/slices/successMessageSlice";
import { Row, Col, Table } from "react-bootstrap";
import { AppURL } from "../../apis/AppURL";
import { getAuthToken } from "../../utils/loaders";

function StudentMarkForm({ method, groups, subjects, evaluations }) {
  const actionData = useActionData();
  const navigate = useNavigate();
  const dispatch = useDispatch();

  const [students, setStudents] = useState([]);
  const [selectedGroupId, setSelectedGroupId] = useState(null);
  const [selectedSubjectId, setSelectedSubjectId] = useState(null);
  const [selectedEvaluationId, setSelectedEvaluationId] = useState(null);

  const token = getAuthToken();

  useEffect(() => {
    const fetchStudents = async () => {
      try {
        const response = await axios.get(AppURL.allStudents(), {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        });

        if (response.data && Array.isArray(response.data.students)) {
          setStudents(response.data.students);
        } else {
          console.error("Data retrieved is not as expected:", response.data);
        }
      } catch (error) {
        console.error("Error fetching students:", error);
      }
    };

    fetchStudents();
  }, [token]);

  useEffect(() => {
    const fetchMarks = async () => {
      if (selectedGroupId && selectedEvaluationId) {
        try {
          const response = await axios.get(AppURL.assignMarksToStudents(), {
            headers: {
              Authorization: `Bearer ${token}`,
            },
            params: {
              group_id: selectedGroupId,
              evaluation_id: selectedEvaluationId,
            },
          });

          if (response.data && Array.isArray(response.data.marks)) {
            const fetchedMarks = response.data.marks;
            const updatedStudents = students.map((student) => {
              const mark = fetchedMarks.find(
                (m) => m.student_id === student.id
              );
              return mark
                ? { ...student, mark: mark.score, comment: mark.comment }
                : student;
            });
            setStudents(updatedStudents);
          } else {
            console.error("Data retrieved is not as expected:", response.data);
          }
        } catch (error) {
          console.error("Error fetching marks:", error);
        }
      }
    };

    fetchMarks();
  }, [selectedGroupId, selectedEvaluationId, token]);

  const handleStudentChange = (e, studentId) => {
    const { name, value } = e.target;
    const updatedStudents = students.map((student) =>
      student.id === studentId ? { ...student, [name]: value } : student
    );
    setStudents(updatedStudents);
  };

  useEffect(() => {
    if (actionData && actionData.message) {
      dispatch(setSuccessMessage(actionData.message));
      navigate("/admin/groups/list");
    }
  }, [actionData, navigate, dispatch]);

  return (
    <Fragment>
      <Form method={method}>
        <Row>
          <Col sm={12} md={6} lg={6}>
            <Input
              label="Groupe"
              name="group_id"
              type="select"
              selectOptions={groups.map((group) => ({
                value: group.id,
                label: group.name,
              }))}
              onChange={(e) => setSelectedGroupId(parseInt(e.target.value))}
              errorMessage={actionData && actionData.errors?.group_id?.[0]}
              required
            />
          </Col>
          <Col sm={12} md={6} lg={6}>
            <Input
              label="Matière"
              name="subject_id"
              type="select"
              selectOptions={subjects.map((subject) => ({
                value: subject.id,
                label: subject.name,
              }))}
              onChange={(e) => setSelectedSubjectId(parseInt(e.target.value))}
              errorMessage={actionData && actionData.errors?.subject_id?.[0]}
              required
            />
          </Col>
          <Col sm={12} md={12} lg={12}>
            <Input
              label="Évaluation"
              name="evaluation_id"
              type="select"
              selectOptions={evaluations
                .filter(
                  (evaluation) =>
                    evaluation.group_id === selectedGroupId &&
                    evaluation.subject_id === selectedSubjectId
                )
                .map((evaluation) => ({
                  value: evaluation.id,
                  label: `Evaluation ${evaluation.evaluation_number}`,
                }))}
              onChange={(e) =>
                setSelectedEvaluationId(parseInt(e.target.value))
              }
              errorMessage={actionData && actionData.errors?.evaluation_id?.[0]}
              required
            />
          </Col>
        </Row>
        <Row className="mt-4">
          <Col>
            <h5>Étudiants :</h5>
            <Table striped bordered hover>
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nom Prénom</th>
                  <th>Note</th>
                  <th>Remarque/commentaire</th>
                </tr>
              </thead>
              <tbody>
                {Array.isArray(students) &&
                  students.length > 0 &&
                  students
                    .filter((student) => student.group_id === selectedGroupId)
                    .map((student) => (
                      <tr key={student.id}>
                        <td>{student.id}</td>
                        <td>{`${student.student_last_name} ${student.student_first_name}`}</td>
                        <td>
                          <input
                            className="form-control form-control-sm"
                            name="mark"
                            type="number"
                            min="0"
                            max="20"
                            step="0.1"
                            value={student.mark || ""}
                            onChange={(e) => handleStudentChange(e, student.id)}
                            required
                          />
                        </td>
                        <td>
                          <textarea
                            className="form-control form-control-sm"
                            name="comment"
                            value={student.comment || ""}
                            onChange={(e) => handleStudentChange(e, student.id)}
                          ></textarea>
                        </td>
                      </tr>
                    ))}
              </tbody>
            </Table>
          </Col>
        </Row>
        <input type="hidden" name="students" value={JSON.stringify(students)} />
        <Button
          text="Soumettre"
          type="submit"
          className="fw-bold float-lg-start me-2"
          backgroundColor="var(--alkarama-primary-color)"
          icon={<BsDatabaseFill />}
          disabled={
            selectedGroupId === null ||
            selectedSubjectId === null ||
            selectedEvaluationId === null
          }
        />
      </Form>
    </Fragment>
  );
}

export default StudentMarkForm;

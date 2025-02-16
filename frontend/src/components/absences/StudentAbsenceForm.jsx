import React, { useEffect, useState, Fragment } from "react";
import axios from "axios";
import { Row, Col, Table, FormCheck } from "react-bootstrap";
import { BsDatabaseFill } from "react-icons/bs";
import { useDispatch } from "react-redux";
import Input from "./../UI/inputs/Input";
import Button from "../UI/buttons/Button";
import { setSuccessMessage } from "../../redux/slices/successMessageSlice";
import { AppURL } from "../../apis/AppURL";
import { getAuthToken } from "../../utils/loaders";
import { Form, useActionData, useNavigate } from "react-router-dom";

function StudentAbsenceForm({ method, groups, subjects }) {
  const actionData = useActionData();
  const navigate = useNavigate();
  const dispatch = useDispatch();

  const [students, setStudents] = useState([]);
  const [selectedGroupId, setSelectedGroupId] = useState(null);
  const [selectedSubjectId, setSelectedSubjectId] = useState(null);
  const [date, setDate] = useState("");
  const [startTime, setStartTime] = useState("");
  const [endTime, setEndTime] = useState("");
  const [absentStudents, setAbsentStudents] = useState([]);

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
    const fetchAttendanceRecords = async () => {
      if (
        selectedGroupId &&
        selectedSubjectId &&
        date &&
        startTime &&
        endTime
      ) {
        try {
          const response = await axios.get(AppURL.attendanceRecords(), {
            params: {
              group_id: selectedGroupId,
              subject_id: selectedSubjectId,
              date,
              start_time: startTime,
              end_time: endTime,
            },
            headers: {
              Authorization: `Bearer ${token}`,
            },
          });

          if (response.data && Array.isArray(response.data)) {
            const attendanceMap = new Map(
              response.data.map((record) => [
                record.student_id,
                record.is_present,
              ])
            );
            setStudents((prevStudents) =>
              prevStudents.map((student) => ({
                ...student,
                absent: attendanceMap.has(student.id)
                  ? !attendanceMap.get(student.id)
                  : false,
              }))
            );
          } else {
            console.error("Data retrieved is not as expected:", response.data);
          }
        } catch (error) {
          console.error("Error fetching attendance records:", error);
        }
      }
    };

    fetchAttendanceRecords();
  }, [selectedGroupId, selectedSubjectId, date, startTime, endTime, token]);

  const handleAbsentChange = (studentId, checked) => {
    if (checked) {
      setAbsentStudents((prevAbsentStudents) => [
        ...prevAbsentStudents,
        studentId,
      ]);
    } else {
      setAbsentStudents((prevAbsentStudents) =>
        prevAbsentStudents.filter((id) => id !== studentId)
      );
    }
    setStudents((prevStudents) =>
      prevStudents.map((student) =>
        student.id === studentId ? { ...student, absent: checked } : student
      )
    );
  };

  useEffect(() => {
    if (actionData && actionData.message) {
      dispatch(setSuccessMessage(actionData.message));
      navigate("/teacher/groups/list");
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
              required
            />
          </Col>
        </Row>
        <Row>
          <Col lg={4} md={12} sm={12}>
            <Input
              label="Date"
              name="date"
              type="date"
              value={date}
              onChange={(e) => setDate(e.target.value)}
              required
            />
          </Col>
          <Col lg={4} md={12} sm={12}>
            <Input
              label="Heure de début"
              name="start_time"
              type="time"
              value={startTime}
              onChange={(e) => setStartTime(e.target.value)}
              required
            />
          </Col>
          <Col lg={4} md={12} sm={12}>
            <Input
              label="Heure de fin"
              name="end_time"
              type="time"
              value={endTime}
              onChange={(e) => setEndTime(e.target.value)}
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
                  <th>Absent</th>
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
                          <FormCheck
                            type="checkbox"
                            name="absent_students[]"
                            value={student.id}
                            checked={student.absent || false}
                            onChange={(e) =>
                              handleAbsentChange(student.id, e.target.checked)
                            }
                          />
                        </td>
                      </tr>
                    ))}
              </tbody>
            </Table>
          </Col>
        </Row>
        <Button
          text="Soumettre"
          type="submit"
          className="fw-bold float-lg-start me-2"
          backgroundColor="var(--alkarama-primary-color)"
          icon={<BsDatabaseFill />}
          disabled={selectedGroupId === null || selectedSubjectId === null}
        />
      </Form>
    </Fragment>
  );
}

export default StudentAbsenceForm;

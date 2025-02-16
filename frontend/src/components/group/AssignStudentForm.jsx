import React, { useEffect, useState, Fragment } from "react";
import axios from "axios";
import { useActionData, Form, useNavigate, Link } from "react-router-dom";
import { BsDatabaseFill } from "react-icons/bs";
import { FaUserGraduate } from "react-icons/fa";
import { LiaChalkboardTeacherSolid } from "react-icons/lia";
import { useDispatch } from "react-redux";
import Input from "./../UI/inputs/Input";
import Button from "../UI/buttons/Button";
import { setSuccessMessage } from "../../redux/slices/successMessageSlice";
import { Row, Col, Table } from "react-bootstrap";
import { AppURL } from "../../apis/AppURL";
import { getAuthToken } from "../../utils/loaders";

function AssignStudentForm({ method, groups }) {
  const actionData = useActionData();
  const navigate = useNavigate();
  const dispatch = useDispatch();

  const [levels, setLevels] = useState([]);
  const [selectedLevel, setSelectedLevel] = useState(null);
  const [filteredSections, setFilteredSections] = useState([]);
  const [filteredGroups, setFilteredGroups] = useState([]);
  const [students, setStudents] = useState([]);
  const [selectedStudents, setSelectedStudents] = useState([]);

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
    const allLevels = groups.map((group) => group.section.level);
    const uniqueLevels = allLevels.filter(
      (level, index, self) => index === self.findIndex((l) => l.id === level.id)
    );
    setLevels(uniqueLevels);
  }, [groups]);

  useEffect(() => {
    if (selectedLevel) {
      const sections = groups
        .filter((group) => group.section.level.id === selectedLevel.id)
        .map((group) => group.section)
        .filter(
          (section, index, self) =>
            index === self.findIndex((s) => s.id === section.id)
        );
      setFilteredSections(sections);
    } else {
      setFilteredSections([]);
      setFilteredGroups([]);
    }
  }, [selectedLevel, groups]);

  const handleSectionChange = (e) => {
    const sectionId = parseInt(e.target.value);
    const groupsForSection = groups.filter(
      (group) => group.section_id === sectionId
    );
    setFilteredGroups(groupsForSection);
  };

  const handleStudentChange = (e) => {
    const studentId = parseInt(e.target.value);
    if (e.target.checked) {
      setSelectedStudents((prev) => [...prev, studentId]);
    } else {
      setSelectedStudents((prev) => prev.filter((id) => id !== studentId));
    }
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
        <Row className="text-center">
          <Col>
            <Link to="/admin/assign/students/groups">
              <Button
                size="small"
                text="Affecter étudiants au groupe"
                backgroundColor="var(--alkarama-primary-color)"
                textColor="var(--alkarama-white)"
                icon={<FaUserGraduate />}
              />
            </Link>
          </Col>
          <Col>
            <Link to="/admin/assign/teachers/groups">
              <Button
                size="small"
                text="Affecter professeurs au groupe"
                backgroundColor="var(--alkarama-primary-color)"
                textColor="var(--alkarama-white)"
                icon={<LiaChalkboardTeacherSolid />}
              />
            </Link>
          </Col>
        </Row>
        <Row>
          <Col sm={12} md={6} lg={4}>
            <Input
              label="Niveau"
              name="level_id"
              type="select"
              selectOptions={levels.map((level) => ({
                value: level.id,
                label: level.name,
              }))}
              onChange={(e) =>
                setSelectedLevel(
                  levels.find((level) => level.id === parseInt(e.target.value))
                )
              }
              required
            />
          </Col>
          <Col sm={12} md={6} lg={4}>
            <Input
              label="Section"
              name="section_id"
              type="select"
              selectOptions={filteredSections.map((section) => ({
                value: section.id,
                label: section.name,
              }))}
              onChange={handleSectionChange}
              required
              disabled={!selectedLevel}
            />
          </Col>
          <Col sm={12} md={6} lg={4}>
            <Input
              label="Groupe"
              name="group_id"
              type="select"
              selectOptions={filteredGroups.map((group) => ({
                value: group.id,
                label: group.name,
              }))}
              errorMessage={actionData && actionData.errors?.group_id?.[0]}
              required
              disabled={filteredGroups.length === 0}
            />
          </Col>
        </Row>
        <Row className="mt-4">
          <Col>
            <h5>Étudiants sans groupe dans la section sélectionnée :</h5>
            <Table striped bordered hover>
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nom</th>
                  <th>Prénom</th>
                  <th>Affecter</th>
                </tr>
              </thead>
              <tbody>
                {Array.isArray(students) &&
                  students.length > 0 &&
                  students
                    .filter((student) =>
                      filteredGroups.length > 0
                        ? student.group_id === null &&
                          student.section_id ===
                            parseInt(filteredGroups[0]?.section_id)
                        : false
                    )
                    .map((student) => (
                      <tr key={student.id}>
                        <td>{student.id}</td>
                        <td>{student.student_last_name}</td>
                        <td>{student.student_first_name}</td>
                        <td>
                          <input
                            name="students[]"
                            type="checkbox"
                            value={student.id}
                            onChange={handleStudentChange}
                            disabled={filteredGroups.length === 0}
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
          disabled={
            filteredGroups.length === 0 || selectedStudents.length === 0
          }
        />
      </Form>
    </Fragment>
  );
}

export default AssignStudentForm;

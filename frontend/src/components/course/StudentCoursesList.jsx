import React, { useState, useEffect } from "react";
import MUIDataTable from "mui-datatables";
import { Row, Col } from "react-bootstrap";
import Input from "./../UI/inputs/Input";
import { BASE_URL } from "../../apis/BaseURL";

const StudentCoursesList = ({ subjects, courses }) => {
  const [courseList, setCourseList] = useState(courses||[]);
  const [filteredCourses, setFilteredCourses] = useState(courses || []);
  const [selectedSubject, setSelectedSubject] = useState("");

  useEffect(() => {
   
    if (selectedSubject) {
      const filtered = courses.filter(
        (course) => course.subject.id === parseInt(selectedSubject)
      );
      setFilteredCourses(filtered);
    } else {
      setFilteredCourses(courseList);
    }
  }, [selectedSubject, courses, courseList]);

  const columns = [
    { name: "Nom du cours", options: { filter: false } },
    { name: "Matière", options: { filter: false } },
    { name: "Groupe", options: { filter: false } },
    { name: "Type", options: { filter: false } },
    {
      name: "Actions",
      options: {
        filter: false,
        customBodyRender: (value, tableMeta) => {
          const course = filteredCourses[tableMeta.rowIndex];
          return (
            <div>
              <a
                href={`${BASE_URL}/storage/${course.file}`}
                download={course.file.split("/").pop()}
                target="_blank"
                rel="noopener noreferrer"
                className="btn btn-primary"
              >
                Télécharger
              </a>
            </div>
          );
        },
      },
    },
  ];

  const options = {
    filterType: "checkbox",
  };

  return (
    <div>
      <Row>
        <Col sm={12} md={6} lg={6}>
          <Input
            label="Matières"
            name="matiere_id"
            type="select"
            required
            selectOptions={subjects.map((subject) => ({
              value: subject.id,
              label: subject.name,
            }))}
            onChange={(e) => {
              setSelectedSubject(e.target.value);
            }}
          />
        </Col>
      </Row>
      <Row>
        <MUIDataTable
          title={"Liste des cours"}
          data={filteredCourses.map((course) => [
            course.course_name,
            course.subject.name,
            course.group.name,
            course.type,
          ])}
          columns={columns}
          options={options}
        />
      </Row>
    </div>
  );
};

export default StudentCoursesList;

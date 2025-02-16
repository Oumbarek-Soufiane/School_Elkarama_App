import { API_BASE_URL } from "./BaseURL";

export const AppURL = {
  userLogin: (user) => `${API_BASE_URL}/${user}/login`,
  userLogout: (user) => `${API_BASE_URL}/${user}/logout`,

  newSchoolYear: () => `${API_BASE_URL}/admin/school-years`,
  allSchoolYears: () => `${API_BASE_URL}/admin/school-years`,
  manageSchoolYear: (id) => `${API_BASE_URL}/admin/school-years/${id}`,

  newLevel: () => `${API_BASE_URL}/admin/levels`,
  allLevels: () => `${API_BASE_URL}/admin/levels`,
  manageLevel: (id) => `${API_BASE_URL}/admin/levels/${id}`,

  newSubject: () => `${API_BASE_URL}/admin/subjects`,
  allSubjects: () => `${API_BASE_URL}/admin/subjects`,
  managesubject: (id) => `${API_BASE_URL}/admin/subjects/${id}`,

  newClassRoom: () => `${API_BASE_URL}/admin/class-rooms`,
  allClassRooms: () => `${API_BASE_URL}/admin/class-rooms`,
  manageClassRoom: (id) => `${API_BASE_URL}/admin/class-rooms/${id}`,

  newSection: () => `${API_BASE_URL}/admin/sections`,
  allSections: () => `${API_BASE_URL}/admin/sections`,
  manageSection: (id) => `${API_BASE_URL}/admin/sections/${id}`,

  newGroup: () => `${API_BASE_URL}/admin/groups`,
  allGroups: () => `${API_BASE_URL}/admin/groups`,
  manageGroup: (id) => `${API_BASE_URL}/admin/groups/${id}`,
  allGroupStudents: (id) => `${API_BASE_URL}/teacher/students/group/${id}`,

  newStudent: () => `${API_BASE_URL}/admin/students`,
  allStudents: () => `${API_BASE_URL}/admin/students`,
  manageStudent: (id) => `${API_BASE_URL}/admin/students/${id}`,

  allStudentNeedTransportation: () =>
    `${API_BASE_URL}/admin/students/need/transportation`,

  newBus: () => `${API_BASE_URL}/admin/buses`,
  allBuses: () => `${API_BASE_URL}/admin/buses`,
  manageBus: (id) => `${API_BASE_URL}/admin/buses/${id}`,

  newTransportStaff: () => `${API_BASE_URL}/admin/transport-staff`,
  allTransportStaff: () => `${API_BASE_URL}/admin/transport-staff`,
  manageTransportStaff: (id) => `${API_BASE_URL}/admin/transport-staff/${id}`,

  newTeacher: () => `${API_BASE_URL}/admin/teachers`,
  allTeachers: () => `${API_BASE_URL}/admin/teachers`,
  manageTeacher: (id) => `${API_BASE_URL}/admin/teachers/${id}`,

  assignStudentToGroup: () => `${API_BASE_URL}/admin/assign/student/group`,
  assignTeacherToGroup: () => `${API_BASE_URL}/admin/assign/teacher/group`,
  teachersAssignedToGroup: (id) =>
    `${API_BASE_URL}/admin/teachers/assignd/group/${id}`,

  newEvaluation: () => `${API_BASE_URL}/admin/evaluations`,
  allEvaluations: () => `${API_BASE_URL}/admin/evaluations`,
  manageEvaluation: (id) => `${API_BASE_URL}/admin/evaluations/${id}`,

  allGuardians: () => `${API_BASE_URL}/admin/guardians`,
  manageGuardian: (id) => `${API_BASE_URL}/admin/guardians/${id}`,

  assignSubjectToSection: () => `${API_BASE_URL}/admin/sectionsubject`,
  getSectionSubjects: (sectionId) =>
    `${API_BASE_URL}/admin/sections/${sectionId}/subjects`,

  registerAdmin: () => `${API_BASE_URL}/admin/register`,
  allAdmins: () => `${API_BASE_URL}/admin/admins`,
  manageAdmin: (id) => `${API_BASE_URL}/admin/admins/${id}`,

  userInfo: (user) => `${API_BASE_URL}/${user}/user`,

  teacherGroups: () => `${API_BASE_URL}/teacher/groups`,
  teacherSubjects: () => `${API_BASE_URL}/teacher/subjects`,
  teacherEvaluations: () => `${API_BASE_URL}/teacher/evaluations`,
  assignMarksToStudents: () => `${API_BASE_URL}/teacher/students/marks`,

  assignAbsencesToStudents: () =>
    `${API_BASE_URL}/teacher/students/attendances`,
  attendanceRecords: () =>
    `${API_BASE_URL}/teacher/students/attendance-records`,

  newCouse: () => `${API_BASE_URL}/teacher/courses`,
  allTeacherCourses: () => `${API_BASE_URL}/teacher/courses`,
  manageCourse: (id) => `${API_BASE_URL}/teacher/courses/${id}`,

  newMessage: () => `${API_BASE_URL}/contact`,
  allContacts: () => `${API_BASE_URL}/admin/contacts`,
  manageConatct: (id) => `${API_BASE_URL}/admin/contacts/${id}`,

  resetpassword: (id) => `${API_BASE_URL}/admin/reset/password/${id}`,

  allStudentSchoolYears: () => `${API_BASE_URL}/student/school-years`,
  studentmarks: () => `${API_BASE_URL}/student/marks`,

  getcoursesstudent: () => `${API_BASE_URL}/student/cours`,

  getAttendanceRecords: () => `${API_BASE_URL}/student/absences`,
  adminDashboard: () => `${API_BASE_URL}/admin/dashboard`,
};

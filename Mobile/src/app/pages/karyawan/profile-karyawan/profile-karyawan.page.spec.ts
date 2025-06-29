import { ComponentFixture, TestBed } from '@angular/core/testing';
import { ProfileKaryawanPage } from './profile-karyawan.page';

describe('ProfileKaryawanPage', () => {
  let component: ProfileKaryawanPage;
  let fixture: ComponentFixture<ProfileKaryawanPage>;

  beforeEach(() => {
    fixture = TestBed.createComponent(ProfileKaryawanPage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});

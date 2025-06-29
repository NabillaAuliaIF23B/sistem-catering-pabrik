import { ComponentFixture, TestBed } from '@angular/core/testing';
import { DataKaryawanPage } from './data-karyawan.page';

describe('DataKaryawanPage', () => {
  let component: DataKaryawanPage;
  let fixture: ComponentFixture<DataKaryawanPage>;

  beforeEach(() => {
    fixture = TestBed.createComponent(DataKaryawanPage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
